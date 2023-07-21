<?php

use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\BrendController;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\FeedbackController;
use App\Http\Controllers\Front\HomeSelectController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\SixStepController;
use App\Http\Controllers\Front\SliderController;
use App\Http\Controllers\Front\TranslationController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/slider', [SliderController::class, 'index']);
Route::get('/product', [ProductController::class, 'index']);
// Route::get('/product', [ProductController::class, 'filter']);
Route::get('/product/{slug}', [ProductController::class, 'show']);
Route::get('/brend', [BrendController::class, 'index']);
Route::post('/feedback', [FeedbackController::class, 'store']);
Route::get('/brend/{id}', [BrendController::class, 'show']);
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::get('/sixstep', [SixStepController::class, 'index']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/aboutdiscription', [AboutController::class, 'discription']);
Route::get('/homeselect', [HomeSelectController::class, 'index']);
Route::get('/locales/uz', [TranslationController::class, 'uz']);
Route::get('/locales/ru', [TranslationController::class, 'ru']);
Route::get('/locales/en', [TranslationController::class, 'en']);

