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

    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText('Product ID: 1');

        $this->get('/products/2')
            ->assertSeeText('Product ID: 2');

        $this->get('/products/10/items/abc')
            ->assertSeeText('Product ID: 10, Item ID: abc');
    }

    public function testRouteParameterRegex()
    {
        $this->get('/categories/100')
            ->assertSeeText('Category ID: 100');

        $this->get('/categories/asd')
            ->assertSeeText('404');
    }

    public function testRouteParameterOptional()
    {
        $this->get('/users/ahok')
            ->assertSeeText('User ID: ahok');

        $this->get('/users')
            ->assertSeeText('User ID: unknown');
    }

    public function testRouteConflict()
    {
        $this->get('/conflict/asd')
            ->assertSeeText('Conflict asd');

        $this->get('/conflict/ahok')
            ->assertSeeText('Conflict ahok');
    }

    public function testNamedRoute()
    {
        $this->get('/produk/asd')
            ->assertSeeText('Link http://localhost/products/asd');

        $this->get('/produk-redirect/asd')
            ->assertRedirect('/products/asd');
    }
}
