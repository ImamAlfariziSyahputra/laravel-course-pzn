<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('hello', [
        'name' => 'Ahok'
    ]);
});

Route::get('/world', function () {
    return view('hello/world', [
        'name' => 'Ahok'
    ]);
});

Route::get('/mamlzy', function () {
    return 'Hello World!';
});

Route::redirect('/imam', '/mamlzy');

Route::fallback(function () {
    return '404';
});
