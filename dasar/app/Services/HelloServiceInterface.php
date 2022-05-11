<?php

namespace App\Services;

interface HelloServiceInterface
{
    public function hello(string $name): string;
}
