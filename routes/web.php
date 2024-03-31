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

Route::get('/add-post',          [PostController::class, 'addPost']);
Route::post('/add-post-submit',  [PostController::class, 'addPostSubmit']);

Route::get('/post-update/{id}',          [PostController::class, 'postUpdate']);
Route::post('/post-update-submit',          [PostController::class, 'postUpdateSubmit']);

Route::get('/post-remove/{id}',          [PostController::class, 'postRemove']);

Route::get('/home',              [PostController::class, 'Home']);
Route::get('/about',             [PostController::class, 'About']);