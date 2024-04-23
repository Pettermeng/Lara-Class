<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\CategoriesController;
use App\Http\Controllers\backend\ProductController;

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
//     return view('welcome');
// });

// Home
Route::get('/',             [HomeController::class, 'Home']);
Route::get('/shop',         [HomeController::class, 'Shop']);
Route::get('/product',      [HomeController::class, 'Product']);
Route::get('/news',         [HomeController::class, 'News']);
Route::get('/article',      [HomeController::class, 'Article']);
Route::get('/search',       [HomeController::class, 'Search']);

// User SignIn & SignUp
Route::get('/signin',        [UserController::class, 'Signin'])->name('login');
Route::post('/signin-submit', [UserController::class, 'SigninSubmit']);

Route::get('/signup',         [UserController::class, 'Signup']);
Route::post('/signup-submit', [UserController::class, 'SignupSubmit']);

Route::get('/admin',             [AdminController::class, 'index']);
Route::get('/admin/add-post',    [AdminController::class, 'AddPost']);
Route::get('/admin/list-post',   [AdminController::class, 'ListPost']);

// @Middleware Auth
Route::middleware(['auth'])->group(function () {

});
