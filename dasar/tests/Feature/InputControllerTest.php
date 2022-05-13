<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=Ahok')
            ->assertSeeText('Hello Ahok');

        $this->post('/input/hello', ['name' => 'Ahok'])
            ->assertSeeText('Hello Ahok');
    }

    public function testNestedInput()
    {
        $this->post('/input/hello/first', [
            'name' => [
                'first' => 'Ahok',
                'last' => 'Jarot'
            ]
        ])->assertSeeText('Hello Ahok');
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            'name' => [
                'first' => 'Ahok',
                'last' => 'Jarot'
            ]
        ])
            ->assertSeeText('name')
            ->assertSeeText('first')
            ->assertSeeText('Ahok')
            ->assertSeeText('last')
            ->assertSeeText('Jarot');
    }


    public function testArrayInput()
    {
        $this->post('/input/hello/array', [
            'address' => [
                [
                    'city' => 'Depok',
                    'country' => 'Indonesia'
                ],
                [
                    'city' => 'Padang',
                    'country' => 'Indonesia'
                ]
            ]
        ])
            ->assertSeeText('Depok')
            ->assertSeeText('Padang');
    }

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Ahok',
            'married' => 'true',
            'birth_date' => '2000-01-01'
        ])
            ->assertSeeText('Ahok')
            ->assertSeeText('true')
            ->assertSeeText('2000-01-01');
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            'name' => [
                'first' => 'Ahok',
                'middle' => 'bin',
                'last' => 'Jarot',
            ]
        ])
            ->assertSeeText('Ahok')
            ->assertSeeText('Jarot')
            ->assertDontSeeText('bin');
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            'username' => 'ahok',
            'password' => 'asd',
            'admin' => 'true',
        ])
            ->assertSeeText('ahok')
            ->assertSeeText('asd')
            ->assertDontSeeText('true');
    }

    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            'username' => 'ahok',
            'password' => 'asd',
            'admin' => 'true',
        ])
            ->assertSeeText('ahok')
            ->assertSeeText('asd')
            ->assertSeeText('admin')
            ->assertSeeText('false');
    }
}
