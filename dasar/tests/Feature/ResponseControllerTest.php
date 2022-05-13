<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse()
    {
        $this->get('/response/hello')
            ->assertSeeText('Hello Response!');
    }

    public function testHeader()
    {
        $this->post('/response/header', [
            'firstName' => 'Ahok',
            'lastName' => 'Jarot'
        ])
            ->assertStatus(200)
            ->assertSeeText('firstName')
            ->assertSeeText('Ahok')
            ->assertSeeText('lastName')
            ->assertSeeText('Jarot')
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('Author', 'mamlzy')
            ->assertHeader('App', 'Belajar Laravel');
    }

    public function testView()
    {
        $this->post('/response/type/view', ['name' => 'Ahok'])
            ->assertSeeText('Hello Ahok!');
    }

    public function testJson()
    {
        $this->post('/response/type/json', [
            'firstName' => 'Ahok',
            'lastName' => 'Jarot',
        ])
            ->assertSeeText('firstName')
            ->assertSeeText('Ahok')
            ->assertSeeText('lastName')
            ->assertSeeText('Jarot');
    }

    public function testFile()
    {
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', 'image/jpeg');
    }

    public function testDownload()
    {
        $this->get('/response/type/download')
            ->assertDownload('dog.jpg');
    }
}
