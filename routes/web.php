<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestTestController;
use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\Blog\Admin\PostController as PostAdminController;
use App\Http\Controllers\Blog\Admin\CategoryController;

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

Route::get('/test', function () {
    return view('welcome');
});

Route::resource( 'rest', RestTestController::class)->names('resTest');
//Route::resource( 'rest', 'App\Http\Controllers\RestTestController')->names('resTest');

Route::group(['namespace' => '', 'prefix' => 'blog'], function () {
    Route::resource( 'posts', PostController::class)->names('blog.posts');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['namespace' => '', 'prefix' => 'admin/blog'], function () {

    // BlogCategory
    $methods = ['index', 'edit', 'store', 'update', 'create', 'store'];
    Route::resource( 'categories', CategoryController::class)
        ->only($methods)
        ->names('blog.admin.categories');

    // BlogPost
    Route::get('posts/{post}/restore', [PostAdminController::class, 'restore'])->name('blog.admin.posts.restore');
    Route::resource( 'posts', PostAdminController::class)
        ->except(['show'])
        ->names('blog.admin.posts');
});


/*Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/
