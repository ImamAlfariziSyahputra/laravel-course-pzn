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
}
