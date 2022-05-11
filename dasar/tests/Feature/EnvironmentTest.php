<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function testGetEnv()
    {
        $name = env('AUTHOR');

        $this->assertEquals('mamlzy', $name);
    }

    public function testDefaultEnv()
    {
        $age = env('AGE', '19');

        $this->assertEquals('19', $age);
    }
}
