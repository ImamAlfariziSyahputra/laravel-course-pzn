<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadesTest extends TestCase
{
    public function testConfig()
    {
        $firstName1 = config('contoh.name.first');
        $firstName2 = Config::get('contoh.name.first');

        $this->assertEquals($firstName1, $firstName2);

        // var_dump(Config::all());
    }

    public function testConfigDependency()
    {
        $config = $this->app->make('config');

        $firstName1 = $config->get('contoh.name.first');
        $firstName2 = config('contoh.name.first');
        $firstName3 = Config::get('contoh.name.first');

        $this->assertEquals($firstName1, $firstName2);
        $this->assertEquals($firstName1, $firstName3);

        // var_dump($config->all());
    }

    public function testMock()
    {
        Config::shouldReceive('get')
            ->with('contoh.name.first')
            ->andReturn('Ahok');

        $firstName = Config::get('contoh.name.first');

        $this->assertEquals('Ahok', $firstName);
    }
}
