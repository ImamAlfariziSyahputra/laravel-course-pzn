<?php

use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
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

Route::get('/products/{id}', function ($id) {
    return "Product ID: $id";
})->name('product.detail');
Route::get('/products/{product}/items/{item}', function ($productId, $itemId) {
    return "Product ID: $productId, Item ID: $itemId";
})->name('product.item.detail');

Route::get('/categories/{id}', function ($categoryId) {
    return "Category ID: $categoryId";
})->where('id', '[0-9]+')->name('category.detail');

Route::get('/users/{id?}', function (string $id = 'unknown') {
    return "User ID: $id";
})->name('user.detail');

Route::get('/conflict/{name}', function (string $name) {
    return "Conflict $name";
});
Route::get('/conflict/ahok', function () {
    return "Conflict Ahok Jarot";
});

Route::get('/produk/{id}', function ($id) {
    $link = route('product.detail', ['id' => $id]);

    return "Link $link";
});
Route::get('/produk-redirect/{id}', function ($id) {
    return redirect()->route('product.detail', ['id' => $id]);
});

//! HelloController
Route::get('/controller/hello/request', [HelloController::class, 'request'])->name('controller.hello.request');
Route::get('/controller/hello/{name}', [HelloController::class, 'hello'])->name('controller.hello');

//! InputController
Route::get('/input/hello', [InputController::class, 'hello']);
Route::post('/input/hello', [InputController::class, 'hello']);
Route::post('/input/hello/first', [InputController::class, 'helloFirst']);
Route::post('/input/hello/input', [InputController::class, 'helloInput']);
Route::post('/input/hello/array', [InputController::class, 'helloArray']);

//! Redirect
Route::redirect('/imam', '/mamlzy');

//! 404 Not Found
Route::fallback(function () {
    return '404';
});
