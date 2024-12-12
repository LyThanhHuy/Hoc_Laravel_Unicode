<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CategoriesController;
use Admin\ProductsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;

// use App\Http\Controllers\Admin\ProductsController;

// use App\Http\Controllers\HomeController;

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

// Route::get('/', function () {
//     $html = '<h1>Hoc lap trinh tai unicode</h1>';
//     return $html;
// });

// Route::get('unicode', function () {
//     // return 'Phuong thuc get cua path /unicode';
//     return view('form');
// });

// Route::post('unicode', function() {
//     return 'Phuong thuc post cua path /unicode';
// });

// Route::put('unicode', function () {
//     return 'Phuong thuc Put cua path /unicode';
// });

// Route::delete('unicode', function () {
//     return 'Phuong thuc Delete cua path /unicode';
// });

// Route::patch('unicode', function () {
//     return 'Phuong thuc Patch cua path /unicode';
// });

// Route::match(['get', 'post'], 'unicode', function () {
//     return $_SERVER['REQUEST_METHOD'];
// });

// Route::any('unicode', function (Request $request) {
//     // return $_SERVER['REQUEST_METHOD'];
//     // $request = new Request();
//     return $request->method();
// });

// Route::get('show-form', function () {
//     return view('form');
// });

// Route::redirect('unicode', 'show-form', 301);

// Route::view('show-form', 'form');

// Route::get('/', 'HomeController@index')->name('home');
// Route::get('/tin-tuc', 'HomeController@getNews')->name('news');
// Route::get('/chuyen-muc/{id}', [HomeController::class, 'getCategories']);

// Route::prefix('admin')->middleware('checkpermission')->group(function () {

//     Route::get('tin-tuc/{id?}/{slug?}.html', function ($id = null, $slug=null) {
//         $content = 'Phuong thuc Get cua path /unicode voi tham so :';
//         $content.='id ='.$id.'<br>';
//         $content.= 'slug ='.$slug;
//         return $content;
//     })->where('id', '[0-9]+')->where('slug', '.+')->name('admin.tintuc');

//     Route::get('show-form', function () {
//         return view('form');
//     })->name('admin.show-form');

//     Route::prefix('products')->group(function () {
//         Route::get('/', function () {
//             return 'Danh sach san pham';
//         });

//         Route::get('/add', function() {
//             return 'Them san pham';
//         })->name('admin.products.add');

//         Route::get('/edit', function () {
//             return 'Sua san pham';
//         });
//     });
// });


Route::get('/', [HomeController::class, 'index'])->name('home');


//Client Routes
Route::middleware('auth.admin')->prefix('categories')->group(function () {
    // Danh sách chuyên mục
    Route::get('/', [CategoriesController::class, 'index'])->name('categories.list');

    // Lấy chi tiết 1 chuyên mục (Áp dụng show form sửa chuyên mục)
    Route::get('/edit/{id}', [CategoriesController::class, 'getCategory'])->name('categories.edit');

    // xử lý update chuyên mục
    Route::post('/edit/{id}', [CategoriesController::class, 'updateCategory']);

    // Hiển thị form add dữ liệu
    Route::get('/add', [CategoriesController::class, 'addCategory'])->name('categories.add');

    //xử lý Thêm chuyên mục
    Route::post('/add', [CategoriesController::class, 'handleAddCategory']);

    // Xóa chuyên mục
    Route::delete('/delete/{id}', [CategoriesController::class, 'deleteCategory'])->name('categories.delete');
});

Route::get('san-pham/{id}', [HomeController::class, 'getProductDetail']);


// Admin Route
Route::middleware('auth.admin')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('products', ProductsController::class)->middleware('auth.admin.product');
});
