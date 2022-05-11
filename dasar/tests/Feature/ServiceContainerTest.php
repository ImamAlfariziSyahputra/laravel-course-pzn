<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloServiceIndonesia;
use App\Services\HelloServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class ServiceContainerTest extends TestCase
{
    public function testDependencyInjection()
    {
        $foo = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        $this->assertEquals('Foo', $foo->foo());
        $this->assertEquals('Foo', $foo2->foo());
        $this->assertNotSame($foo, $foo2);
    }

    public function testBind()
    {
        $this->app->bind(Person::class, function ($app) {
            return new Person('Imam', 'Alfarizi');
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        $this->assertEquals('Imam', $person1->firstName);
        $this->assertEquals('Imam', $person2->firstName);
        $this->assertNotSame($person1, $person2);
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person('Imam', 'Alfarizi');
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        $this->assertEquals('Imam', $person1->firstName);
        $this->assertEquals('Imam', $person2->firstName);
        $this->assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person = new Person('Imam', 'Alfarizi');
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        $this->assertEquals('Imam', $person1->firstName);
        $this->assertEquals('Imam', $person2->firstName);
        $this->assertSame($person, $person1);
        $this->assertSame($person1, $person2);
    }

    public function testInterfaceToClass()
    {

        //! With Class
        // $this->app->singleton(
        //     HelloServiceInterface::class,
        //     HelloServiceIndonesia::class
        // );
        //! With Closure function
        $this->app->singleton(HelloServiceInterface::class, function ($app) {
            return new HelloServiceIndonesia();
        });

        $helloServiceInt = $this->app->make(HelloServiceInterface::class);

        $this->assertEquals('Halo Ahok!', $helloServiceInt->hello('Ahok'));
    }
}
