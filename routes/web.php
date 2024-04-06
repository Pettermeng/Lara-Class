<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/post',              [PostController::class, 'listPost']);
Route::get('/post-detail/{id}',  [PostController::class, 'postDetail']);



Route::get('/post-update/{id}',          [PostController::class, 'postUpdate']);
Route::post('/post-update-submit',          [PostController::class, 'postUpdateSubmit']);

Route::get('/post-remove/{id}',          [PostController::class, 'postRemove']);

Route::get('/home',              [PostController::class, 'Home']);
Route::get('/about',             [PostController::class, 'About']);

// User register & login
Route::get('/login',                [PostController::class, 'userLogin'])->name('login');
Route::post('/login-submit',        [PostController::class, 'userLoginSubmit']);
Route::get('/register',             [PostController::class, 'userRegister']);
Route::post('/register-submit',     [PostController::class, 'userRegisterSubmit']);

// Protect route by middleware
Route::middleware(['auth'])->group(function () {
    
    Route::get('/add-post',          [PostController::class, 'addPost']);
    Route::post('/add-post-submit',  [PostController::class, 'addPostSubmit']);

});