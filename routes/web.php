<?php

use App\Http\Controllers\Dashboard\AboutController;
use App\Http\Controllers\Dashboard\AboutDiscriptionController;
use App\Http\Controllers\Dashboard\BrendController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CharactricController;
use App\Http\Controllers\Dashboard\DataController;
use App\Http\Controllers\Dashboard\FeedbackController;
use App\Http\Controllers\Dashboard\HomeSelectControll;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\SixStepController;
use App\Http\Controllers\Dashboard\SliderController;
use App\Http\Controllers\Dashboard\WordController;
use Illuminate\Support\Facades\Route;

//Localization
// Route::get('/ru', function () {
//     session()->put('locale', 'ru');
//     return redirect()->back();
// })->name('languages');
// Route::get('/uz', function () {
//         session()->put('locale', 'uz');
//         return redirect()->back();
// })->name('languages');

//Front
Route::get('/', [\App\Http\Controllers\Front\FrontController::class, 'index'])->name('main');

Route::get('/optimize', function () {
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('route:cache');
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    return 'success';
});

//Dashboard
Route::group(['prefix' => 'dashboard'], function () {
    Route::name('dashboard.')->group(function () {

        Route::get('/', [\App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('index');
        Route::resource('/slider', SliderController::class);
        Route::resource('/brend', BrendController::class);
        Route::resource('/category', CategoryController::class);
        Route::resource('/product', ProductController::class);
        Route::resource('/sixstep', SixStepController::class);
        Route::resource('/aboutdiscription', AboutDiscriptionController::class);
        Route::resource('/about', AboutController::class);
        Route::resource('/homeselect', HomeSelectControll::class);
        Route::resource('/feedback', FeedbackController::class);
        Route::get('/charactric/{product_id}/index', [CharactricController::class, 'index'])->name('charactric.index');
        Route::post('/charactric/store', [CharactricController::class, 'store'])->name('charactric.store');
        Route::put('/charactric/{id}/update', [CharactricController::class, 'update'])->name('charactric.update');
        Route::delete('/charactric/{id}', [CharactricController::class, 'destroy'])->name('charactric.destroy');

        Route::get('/data/{product_id}/index', [DataController::class, 'index'])->name('data.index');
        Route::post('/data/store', [DataController::class, 'store'])->name('data.store');
        Route::put('/data/{id}/update', [DataController::class, 'update'])->name('data.update');
        Route::delete('/data/{id}', [DataController::class, 'destroy'])->name('data.destroy');
        Route::get('/optimize', function () {
            \Illuminate\Support\Facades\Artisan::call('route:clear');
            \Illuminate\Support\Facades\Artisan::call('cache:clear');
            \Illuminate\Support\Facades\Artisan::call('config:clear');
            \Illuminate\Support\Facades\Artisan::call('config:cache');
            \Illuminate\Support\Facades\Artisan::call('route:cache');
            \Illuminate\Support\Facades\Artisan::call('optimize:clear');
            return 'success';
        });
        Route::get('dashboard/words', [WordController::class, 'index'])->name('words.index');
    });
});


require __DIR__ . '/auth.php';
