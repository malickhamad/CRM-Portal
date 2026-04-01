<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\StripePaymentController;


// frontend routes




// Route::get('/', [HomeController::class, 'home'])->name('frontend.home');
Route::get('/pricing-plans', [HomeController::class, 'pricing'])->name('frontend.pricing');
Route::get('/about-us', [HomeController::class, 'about'])->name('frontend.about');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('frontend.contact');

Route::get('/career', [HomeController::class, 'career'])->name('frontend.career');
Route::get('/help', [HomeController::class, 'help'])->name('frontend.help');
Route::get('/job-detail', [HomeController::class, 'jobdetail'])->name('frontend.job-detail');
Route::get('/product-detail', [HomeController::class, 'productdetail'])->name('frontend.product-detail');
Route::get('/service', [HomeController::class, 'service'])->name('frontend.service');
Route::get('/shop-grid', [HomeController::class, 'shopgrid'])->name('frontend.shop-grid');
Route::get('/shop-list', [HomeController::class, 'shoplist'])->name('frontend.shop-list');
Route::get('/team', [HomeController::class, 'team'])->name('frontend.team');
Route::get('/term-conditions', [HomeController::class, 'termconditions'])->name('frontend.term-conditions');
Route::get('/coming-soon', [HomeController::class, 'comingsoon'])->name('frontend.coming-soon');




//contact us email routes
Route::post('/about-us', [ContactController::class, 'store'])->name('contact.store');
Route::post('/contact/send', [ContactController::class, 'sendContactEmail'])->name('frontend.contact.send');


// Stripe Payment
Route::match(['get', 'post'], '/checkout/{planId}', [StripePaymentController::class, 'checkout'])->name('checkout');
 Route::get('/success', [StripePaymentController::class, 'success'])->name('stripe.success');
 Route::get('/cancel', [StripePaymentController::class, 'cancel'])->name('stripe.cancel');





