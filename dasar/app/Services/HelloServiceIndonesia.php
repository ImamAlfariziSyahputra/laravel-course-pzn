<?php

namespace App\Services;

class HelloServiceIndonesia implements HelloServiceInterface
{
    public function hello(string $name): string
    {
        return "Halo $name!";
    }
}
