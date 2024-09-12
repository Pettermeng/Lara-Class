<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login',                 [ApiController::class, 'userLogin']);

Route::middleware('auth:sanctum')->group( function () {

    Route::get('/news',                 [ApiController::class, 'listNews']);
    Route::get('/news/{slug}',          [ApiController::class, 'getNewsByslug']);
    Route::post('/news/add',            [ApiController::class, 'addNews']);

});


