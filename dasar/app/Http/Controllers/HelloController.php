<?php

namespace App\Http\Controllers;

use App\Services\HelloServiceInterface;
use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function __construct(private HelloServiceInterface $helloService)
    {
    }

    public function hello(Request $request, string $name): string
    {
        return $this->helloService->hello($name);
    }

    public function request(Request $request)
    {
        return $request->path() . PHP_EOL .
            $request->url() . PHP_EOL .
            $request->fullUrl() . PHP_EOL .
            $request->method() . PHP_EOL .
            $request->isMethod('GET') . PHP_EOL .
            $request->header('Accept') . PHP_EOL;
    }
}
