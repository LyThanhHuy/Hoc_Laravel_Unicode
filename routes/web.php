<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// use Admin\ProductsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UsersController;
use App\Models\Categories;
use App\Models\Country;
use App\Models\Groups;
use App\Models\Mechanics;
use App\Models\Posts;
use App\Models\User;
use App\Models\Users;
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


Route::get('/', function () {
    echo '<h2>Migrations Laravel</h2>';
});
