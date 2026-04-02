<?php

use App\Http\Controllers\Admin\{ CustomersController, DashboardController, FaqController, PermissionController, RoleController, UserController, };
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LogsController;
use App\Http\Controllers\Admin\MYProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Frontend\ContactController;
use Illuminate\Support\Facades\Route;



// Route to redirect to admin dashboard
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});


Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);





    //  profile routes
    Route::get('/my-profile', [MYProfileController::class, 'showProfile'])->name('my-profile');
    Route::post('/my-profile/update', [MYProfileController::class, 'updateProfile'])->name('update-profile');

    Route::get('/account-settings', [MYProfileController::class, 'showAccountSettings'])->name('account-settings');
    Route::post('/account-settings/update-password', [MYProfileController::class, 'updatePassword'])->name('update-password');


    // New Application routes


 Route::get('/services', [ApplicationController::class, 'services'])->name('services');
 Route::get('/finance_services', [ApplicationController::class, 'finance_services'])->name('finance_services');
 Route::get('/utilities_services', [ApplicationController::class, 'utilities_services'])->name('utilities_services');


Route::prefix('finance')->group(function () {

    Route::get('/card_machine', [ApplicationController::class, 'card_machine'])->name('card_machine');

    Route::get('/loan', [ApplicationController::class, 'loan'])->name('loan');

    Route::get('/open_banking', [ApplicationController::class, 'open_banking'])->name('open_banking');

});


Route::prefix('utilities')->group(function () {

    Route::get('/water', [ApplicationController::class, 'water'])->name('water');

    Route::get('/broadband', [ApplicationController::class, 'broadband'])->name('broadband');

    Route::get('/telecom', [ApplicationController::class, 'telecom'])->name('telecom');

    Route::get('/gas', [ApplicationController::class, 'gas'])->name('gas');

    Route::get('/electricity', [ApplicationController::class, 'electricity'])->name('electricity');

    Route::get('/electric_gas', [ApplicationController::class, 'electric_gas'])->name('electric_gas');

});



    // logs

    Route::delete('/logs/{id}', [LogsController::class, 'destroy'])->name('logs.destroy');
    Route::get('/logs', [LogsController::class, 'index'])->name('logs.logs');
    Route::delete('/logs/{id}', [LogsController::class, 'destroy'])->name('logs.destroy');
    Route::post('/logs/clear', [LogsController::class, 'clearAll'])->name('logs.clear');

    // permissions routes
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('/permissions/{id}/update', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    // contactpage
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::delete('/contacts/{permission}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    Route::get('/assesments', [ContactController::class, 'assesments'])->name('assesments.index');


    //FAQS routes
    Route::resource('faqs', FaqController::class);


    // Testimonial routes
    Route::resource('testimonials', TestimonialController::class);

    // categories rouets
    Route::resource('categories', CategoryController::class);

    // Customer details

    Route::get('/customers', [CustomersController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [CustomersController::class, 'create'])->name('customers.create');
    Route::post('/customers/store', [CustomersController::class, 'store'])->name('customers.store');
    Route::get('/customers/{id}/payment', [CustomersController::class, 'payment'])->name('customers.payment');
    Route::post('/customers/{id}/process-payment', [CustomersController::class, 'processPayment'])->name('customers.process-payment');
    Route::get('/customers/{id}', [CustomersController::class, 'show'])->name('customers.show');
    // Edit routes
    Route::get('customers/{id}/edit', [CustomersController::class, 'editStep1'])->name('customers.edit.step1');
    Route::put('customers/{id}/update-step1', [CustomersController::class, 'updateStep1'])->name('customers.update.step1');
    Route::get('customers/{id}/edit-step2', [CustomersController::class, 'editStep2'])->name('customers.edit.step2');
    Route::put('customers/{id}/update-step2', [CustomersController::class, 'updateStep2'])->name('customers.update.step2');
    Route::delete('customers/{id}', [CustomersController::class, 'destroy'])->name('customers.destroy');
    Route::post('customers/update-status', [CustomersController::class, 'updateStatus'])
        ->name('customers.update-status');


    // Settings routes
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('settings/create', [SettingsController::class, 'create'])->name('settings.create');
    Route::post('settings', [SettingsController::class, 'store'])->name('settings.store');
    Route::get('settings/{setting}/edit', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('settings/{setting}', [SettingsController::class, 'update'])->name('settings.update');
    Route::delete('settings/{setting}', [SettingsController::class, 'destroy'])->name('settings.destroy');

    // New route to handle dynamic group-based update (for tabbed settings)
    Route::post('settings/group-update', [SettingsController::class, 'updateGroupSettings'])->name('settings.group-update');





});
