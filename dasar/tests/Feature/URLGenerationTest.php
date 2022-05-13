<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase
{
    public function testURLCurrent()
    {
        $this->get('/url/current?name=Ahok')
            ->assertSeeText('/url/current?name=Ahok');
    }

    public function testNamed()
    {
        $this->get('/redirect/named')
            ->assertSeeText('/redirect/name/Ahok');
    }

    public function testAction()
    {
        $this->get('/url/action')
            ->assertSeeText('/form');
    }
}
