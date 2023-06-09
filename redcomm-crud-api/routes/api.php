<?php

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

Route::get('posts', [PostController::class, 'index']);
Route::post('post/{uuid}', [PostController::class, 'show']);
Route::post('post/create', [PostController::class, 'create']);
Route::post('post/update{uuid}', [PostController::class, 'update']);
Route::post('post/destroy/{uuid}', [PostController::class, 'destroy']);