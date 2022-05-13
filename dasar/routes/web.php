<?php

use App\Exceptions\ValidationException;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\ContohMiddleware;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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
Route::get('/controller/hello/request', [HelloController::class, 'request'])
    ->name('controller.hello.request');
Route::get('/controller/hello/{name}', [HelloController::class, 'hello'])
    ->name('controller.hello');

//! InputController
Route::controller(InputController::class)->group(function () {
    Route::get('/input/hello', 'hello');
    Route::post('/input/hello', 'hello');
    Route::post('/input/hello/first', 'helloFirst');
    Route::post('/input/hello/input', 'helloInput');
    Route::post('/input/hello/array', 'helloArray');
    Route::post('/input/type', 'inputType');
    Route::post('/input/filter/only', 'filterOnly');
    Route::post('/input/filter/except', 'filterExcept');
    Route::post('/input/filter/merge', 'filterMerge');
});

//! FileController
Route::post('/file/upload', [FileController::class, 'upload'])
    ->withoutMiddleware([VerifyCsrfToken::class]);

//! ResponseController
Route::controller(ResponseController::class)->group(function () {
    Route::get('/response/hello', 'response');
    Route::post('/response/header', 'header');
    Route::prefix('/response/type')->group(function () {
        Route::post('/view', 'responseView');
        Route::post('/json', 'responseJson');
        Route::get('/file', 'responseFile');
        Route::get('/download', 'responseDownload');
    });
});

//! Cookie Controller
Route::controller(CookieController::class)->group(function () {
    Route::get('/cookie/set', 'createCookie');
    Route::get('/cookie/get', 'getCookie');
    Route::get('/cookie/clear', 'clearCookie');
});

//! Redirect Controller
Route::controller(RedirectController::class)->prefix('/redirect')->group(function () {
    Route::get('/from', 'redirectFrom');
    Route::get('/to', 'redirectTo');
    Route::get('/name', 'redirectName');
    Route::get('/action', 'redirectAction');
    Route::get('/name/{name}', 'redirectHello')->name('redirect.hello');
    Route::get('/away', 'redirectAway');
});

//! Route with Custom Middleware
Route::middleware(['contoh:LZY,401'])->prefix('/middleware')->group(function () {
    Route::get('/api', function () {
        return "OK";
    });
    Route::get('/group', function () {
        return "GROUP";
    });
});

//! Form Controller
Route::get('/form', [FormController::class, 'form']);
Route::post('/form', [FormController::class, 'submitForm']);

//! URL Generation (ways to Getting Url Path)
Route::get('/url/current', function () {
    return URL::full();
});
Route::get('/redirect/named', function () {
    return route('redirect.hello', ['name' => 'Ahok']); //! first way
    // return url()->route('redirect.hello', ['name' => 'Ahok']); //! second way
    // return URL::route('redirect.hello', ['name' => 'Ahok']); //! third way
});
Route::get('/url/action', function () {
    return action([FormController::class, 'form']); //! first way
    // return url()->action([FormController::class, 'form']); //! second way
    // return URL::action([FormController::class, 'form']); //! third way
});

//! Session Controller
Route::get('/session/create', [SessionController::class, 'createSession']);
Route::get('/session/get', [SessionController::class, 'getSession']);

//! Error Report Example
Route::get('/error/sample', function () {
    throw new Exception('Sample Error');
});
Route::get('/error/manual', function () {
    //! Error nya gak tampil dilayar, pakai function "report()"
    report(new Exception('Sample Error'));

    return "OK";
});
Route::get('/error/validation', function () {
    throw new ValidationException('Validation Error');
});

//! HTTP Exception
Route::prefix('/abort')->group(function () {
    Route::get('/400', function () {
        abort(400, 'Upssss something went wrong...');
    });
    Route::get('/401', function () {
        abort(401);
    });
    Route::get('/500', function () {
        abort(500);
    });
});

//! Redirect
Route::redirect('/imam', '/mamlzy');

//! 404 Not Found
Route::fallback(function () {
    return '404';
});
