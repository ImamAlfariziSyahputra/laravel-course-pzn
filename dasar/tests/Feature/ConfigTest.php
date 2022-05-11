<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigTest extends TestCase
{
    public function testConfig()
    {
        $firstName = config('contoh.name.first');
        $lastName = config('contoh.name.last');
        $age = config('contoh.age');
        $email = config('contoh.email');

        $this->assertEquals('Imam', $firstName);
        $this->assertEquals('Alfarizi', $lastName);
        $this->assertEquals('19', $age);
        $this->assertEquals('imam.alfarizi.777@gmail.com', $email);
    }
}
