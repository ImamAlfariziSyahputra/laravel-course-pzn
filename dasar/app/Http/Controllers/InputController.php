<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function hello(Request $request): string
    {
        $name = $request->input('name');

        return "Hello $name";
    }

    public function helloFirst(Request $request): string
    {
        $firstName = $request->input('name.first');

        return "Hello $firstName";
    }

    public function helloInput(Request $request): string
    {
        $input = $request->input();

        return json_encode($input);
    }

    public function helloArray(Request $request): string
    {
        $cities = $request->input('address.*.city');

        return json_encode($cities);
    }
}
