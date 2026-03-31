<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;



Auth::routes();


Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard'); // This route is used as FIRST route after login. This will differentiate roles accordingly.
});


Route::get('/optimize-clear', function () {
    Artisan::call('optimize:clear');
    return "Cache cleared!";
});

Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    return "Cache cleared!";
});

Route::get('/route-clear', function () {
    Artisan::call('route:clear');
    return "route cleared!";
});

Route::get('/view-clear', function () {
    Artisan::call('view:clear');
    return "view cleared!";
});

Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    return "configerd  cache";
});

Route::get('/migrate', function () {
    Artisan::call('migrate');
    return "Migration executed!";
});

Route::get('/migrate-fresh', function () {
    Artisan::call('migrate:fresh');
    return "Fresh Migration executed!";
});

Route::get('/db-seed', function () {
    Artisan::call('db:seed');
    return "Seeder executed!";
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return "Storage linked!";
});



 Route::get('/services', [PageController::class, 'services'])->name('services');
 Route::get('/finance_services', [PageController::class, 'finance_services'])->name('finance_services');
 Route::get('/utilities_services', [PageController::class, 'utilities_services'])->name('utilities_services');
 Route::get('/card_machine', [PageController::class, 'card_machine'])->name('card_machine');
