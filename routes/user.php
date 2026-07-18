<?php

use App\Http\Controllers\User\MYProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\SubuserController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\PermissionController;
use App\Http\Controllers\User\SubscriptionController;
use App\Http\Controllers\User\UpgradePlanController;

Route::middleware(['auth', 'role:User|Subuser'])->prefix('user')->name('user.')->group(function () {
    // Add your routes here
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //subuserdashboard route
    Route::get('/subuserdashboard', [\App\Http\Controllers\Subuser\DashboardController::class, 'index'])->name('subuserdashboard');

    Route::resource('roles', RoleController::class);
    // Subuser routes
    Route::prefix('subusers')->middleware('subscription')->name('subusers.')->group(function () {
        Route::get('/', [SubuserController::class, 'index'])->name('index'); // List all subusers
        Route::get('/create', [SubuserController::class, 'create'])->name('create'); // Show create form
        Route::post('/', [SubuserController::class, 'store'])->name('store'); // Store subuser
        Route::get('/{subuser}', [SubuserController::class, 'show'])->name('show'); // Show subuser details
        Route::get('/{subuser}/edit', [SubuserController::class, 'edit'])->name('edit'); // Show edit form
        Route::put('/{subuser}', [SubuserController::class, 'update'])->name('update'); // Update subuser
        Route::delete('/{subuser}', [SubuserController::class, 'destroy'])->name('destroy'); // Delete subuser

        // Subuser permissions routes
        Route::get('/{subuser}/permissions', [SubuserController::class, 'editPermissions'])->name('permissions'); // Edit permissions
        Route::post('/{subuser}/permissions', [SubuserController::class, 'updatePermissions'])->name('permissions.update'); // Update permissions
    });

    // Permissions routes
    Route::post('/permissions/assign/{subuser}', [PermissionController::class, 'assignPermissionsToSubuser'])->name('permissions.assign');







    // Permissions for users
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index'); // For the index view
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create'); // For the create view
    Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit'); // For the edit view
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store'); // For storing new permission
    Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update'); // For updating a permission
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy'); // For deleting a permission



    Route::get('/subusers/{subuser}/permissions', [SubuserController::class, 'editPermissions'])->name('subusers.permissions'); // Open a form for assigning permissions
    Route::post('/subusers/{subuser}/permissions', [SubuserController::class, 'updatePermissions'])->name('subusers.permissions.update'); // Save assigned permissions
    Route::post('/permissions/assign/{subuser}', [PermissionController::class, 'assignPermissionsToSubuser'])->name('permissions.assign'); // Assign permissions programmatically








    Route::get('/subscription/{id}', [SubscriptionController::class, 'show'])
        ->name('subscription.show');



    Route::get('/account-settings', [MYProfileController::class, 'showAccountSettings'])->name('account-settings');
    // Route::post('/account-settings/update-password', [MYProfileController::class, 'updatePassword'])->name('update-password');
    Route::post('/account-settings/update-password', [MYProfileController::class, 'updatePassword'])->name('update-password');
    // User Profile Routes
    Route::get('profile', [MYProfileController::class, 'showProfile'])->name('profile');
    Route::post('profile', [MYProfileController::class, 'updateProfile']);

    Route::get('subscription', [MYProfileController::class, 'showSubscription'])->name('subscription');
    Route::post('subscription', [MYProfileController::class, 'updateSubscription']);

    //Upgrade Plan Routes

    Route::get('/upgrade', [UpgradePlanController::class, 'index'])->name('upgrade.index');
    Route::post('/upgrade', [UpgradePlanController::class, 'store'])->name('upgrade.store');
    Route::delete('/upgrade/{id}', [UpgradePlanController::class, 'cancel'])->name('upgrade.cancel');
});
