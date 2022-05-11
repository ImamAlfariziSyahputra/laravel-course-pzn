<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/mamlzy')
            ->assertStatus(200)
            ->assertSeeText('Hello World!');
    }

    public function testRedirect()
    {
        $this->get('/imam')
            ->assertRedirect('/mamlzy');
    }

    public function testFallback()
    {
        $this->get('/unknown')
            ->assertSeeText('404');

        $this->get('/gakada')
            ->assertSeeText('404');

        $this->get('/asal')
            ->assertSeeText('404');
    }
}
