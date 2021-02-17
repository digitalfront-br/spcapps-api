<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{MeetingController, AuthController, CategoryController, QuestionController, UserController};

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('create-account', [AuthController::class, 'createAccount']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{id}', [CategoryController::class, 'show']);
    Route::get('user-meet', [UserController::class, 'meetings']);
    Route::get('questions', [QuestionController::class, 'index']);
    Route::get('categories-questions', [QuestionController::class, 'categoryQuestion']);
    Route::get('meeting', [MeetingController::class, 'index']);
    Route::post('meeting', [MeetingController::class, 'store']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
