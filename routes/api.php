<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DataItemController;
use App\Http\Controllers\RestoController;
use App\Http\Controllers\BannerController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('books', [BookController::class, 'index']);
    Route::post('book', [BookController::class, 'store']);
    Route::get('books/{book}', [BookController::class, 'show']);
    Route::put('book/{book}', [BookController::class, 'update']);
    Route::delete('book/{book}', [BookController::class, 'destroy']);

    Route::get('dataItems', [DataItemController::class, 'index']);
    Route::post('dataItem', [DataItemController::class, 'store']);
    Route::get('dataItem/{dataItem}', [DataItemController::class, 'show']);
    Route::put('dataItem/{dataItem}', [DataItemController::class, 'update']);
    Route::delete('dataItem/{dataItem}', [DataItemController::class, 'destroy']);
});

Route::get('resto', [RestoController::class, 'index']);
Route::post('resto', [RestoController::class, 'store']);
Route::get('resto/{id}', [RestoController::class, 'show']);
Route::put('resto/{id}', [RestoController::class, 'update']);
Route::delete('resto/{id}', [RestoController::class, 'destroy']);

Route::get('banner', [BannerController::class, 'index']);
Route::post('banner', [BannerController::class, 'store']);
Route::get('banner/{id}', [BannerController::class, 'show']);
Route::put('banner/{id}', [BannerController::class, 'update']);
Route::delete('banner/{id}', [BannerController::class, 'destroy']);


// https://blog.pusher.com/build-rest-api-laravel-api-resources/
// https://github.com/ammezie/book-reviews-api/blob/master/app/Http/Controllers/BookController.php
// Route::apiResource('books', [BookController::class, 'index']);
// Route::post('books/{book}/ratings', 'RatingController@store');