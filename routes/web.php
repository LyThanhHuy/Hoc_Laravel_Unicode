<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// use Admin\ProductsController;
use App\Http\Controllers\HomeController;

// use App\Http\Controllers\Admin\ProductsController;

// use App\Http\Controllers\HomeController;

use Illuminate\Http\Response;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/san-pham', [HomeController::class, 'products'])->name('product');

Route::get('/them-san-pham', [HomeController::class, 'getAdd']);

// Route::post('/them-san-pham', [HomeController::class, 'postAdd']);

Route::put('/them-san-pham', [HomeController::class, 'putAdd']);

Route::get('lay-thong-tin', [HomeController::class, 'getArr']);

Route::get('demo-response', function () {
    // $response = new Response('Hoc lap trinh tai unicode', 200);
    // $response = response('Hoc lap trinh tai unicode', 404);
    // return new Response('Hoc lap trinh tai unicode', 404);
    // $content = 'Học lập trình tại unicode';
    // $content = json_encode([
    //     'Item 1',
    //     'Item 2',
    //     'item 3'
    // ]);
    // $response = (new Response($content))->header('Content-Type', 'application/json');

    $response = response()->view('clients.demo-test', [
        'title' => 'Hoc HTTP Response'
    ], 201)->header('Content-Type', 'application/json')->header('API-Key', '123456');
    return $response;
});
