<?php

use App\Http\Controllers\Admin\{CustomersController, DashboardController, FaqController, PermissionController, RoleController, UserController, };
use App\Http\Controllers\Admin\ApplicationCommentController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LogsController;
use App\Http\Controllers\Admin\MYProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\NotepadController;
use Illuminate\Support\Facades\Route;



// Route to redirect to admin dashboard
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});


Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);


    // new application create routes...
    Route::post('/applications/store', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications/{id}/edit', [ApplicationController::class, 'edit'])->name('applications.edit');
    Route::put('/applications/{id}/update', [ApplicationController::class, 'update'])->name('applications.update');
    Route::delete('/applications/{id}/destroy', [ApplicationController::class, 'destroy'])->name('applications.destroy');

    // Route to update application status
    Route::post('/applications/{id}/status', [ApplicationController::class, 'updateStatus']);

    // Notepad routes
    Route::post('notepad/upload-image', [NotepadController::class, 'uploadImage'])
        ->name('notepad.upload.image');


    // Application comments routes
    Route::get('/admin/applications', [ApplicationController::class, 'applications'])->name('admin.applications');

    Route::post('/admin/applications/{application}/comments', [ApplicationCommentController::class, 'store'])
        ->name('applications.comments.store');




    //  profile routes
    Route::get('/my-profile', [MYProfileController::class, 'showProfile'])->name('my-profile');
    Route::post('/my-profile/update', [MYProfileController::class, 'updateProfile'])->name('update-profile');

    Route::get('/account-settings', [MYProfileController::class, 'showAccountSettings'])->name('account-settings');
    Route::post('/account-settings/update-password', [MYProfileController::class, 'updatePassword'])->name('update-password');


    // New Application routes


    Route::get('/services', [ApplicationController::class, 'services'])->name('services');
    Route::get('/finance_services', [ApplicationController::class, 'finance_services'])->name('finance_services');
    Route::get('/utilities_services', [ApplicationController::class, 'utilities_services'])->name('utilities_services');
    Route::get('/applications', [ApplicationController::class, 'applications'])->name('applications');

    //  Route::get('/notepad', [ApplicationController::class, 'notepad'])->name('notepad');

    Route::resource('notepad', NotepadController::class);


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

    // Route to print application as PDF

    Route::get('/admin/applications/{id}/print', [ApplicationController::class, 'print'])
        ->name('applications.print');

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
