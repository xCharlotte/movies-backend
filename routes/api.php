<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Movies\MovieController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/movies', [MovieController::class, 'index']);
    Route::get('/movies/{path}', [MovieController::class, 'show']);
    Route::get('/movies/favorite/get/all', [MovieController::class, 'showFavorite']);
    Route::post('/movies/favorite', [MovieController::class, 'storeFavorite']);
    Route::delete('/movies/favorite/remove/{movie_id}', [MovieController::class, 'removeFavorite']);
});
