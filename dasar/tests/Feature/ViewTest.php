<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Ahok!');
    }

    public function testNested()
    {
        $this->get('/world')
            ->assertSeeText('World Ahok!');
    }

    public function testViewWithoutRoute()
    {
        $this->view('hello', ['name' => 'Ahok'])
            ->assertSeeText('Hello Ahok!');
        $this->view('hello.world', ['name' => 'Ahok'])
            ->assertSeeText('World Ahok!');
    }
}
