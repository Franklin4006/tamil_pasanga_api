<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('otp_verify', [AuthController::class, 'otp_verify']);

// Route::middleware('auth:api')->group(function () {

    Route::get('fetch-tag-list', [TagController::class, 'fetchTagList']);

    // Create Post
    Route::post('create-post', [PostController::class, 'createPost']);

    // Post List
    Route::get('fetch-post-list', [PostController::class, 'listPost']);

    Route::post('logout', [AuthController::class, 'logout']);
// });
