<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard');

// Language switching route
Route::get('language/{locale}', [LanguageController::class, 'switchLang'])->name('language.switch');

// Dark mode toggle route
Route::get('dark-mode/toggle', [\App\Http\Controllers\ThemeController::class, 'toggleDarkMode'])->name('dark-mode.toggle');


Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Routes
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // Profile routes
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');

    // User Management Routes
    Route::middleware(['permission:users.create'])->group(function() {
        Route::get('users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
        Route::post('users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    });

    Route::middleware(['permission:users.view'])->group(function() {
        Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
        Route::get('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
        Route::get('users-data', [\App\Http\Controllers\Admin\UserController::class, 'getData'])->name('users.data');
    });

    Route::middleware(['permission:users.edit'])->group(function() {
        Route::get('users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
        Route::put('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
        Route::patch('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update']);
    });

    Route::middleware(['permission:users.delete'])->group(function() {
        Route::delete('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
    });

    // Role Management Routes
    Route::middleware(['permission:roles.create'])->group(function() {
        Route::get('roles/create', [\App\Http\Controllers\Admin\RoleController::class, 'create'])->name('roles.create');
        Route::post('roles', [\App\Http\Controllers\Admin\RoleController::class, 'store'])->name('roles.store');
    });

    Route::middleware(['permission:roles.view'])->group(function() {
        Route::get('roles', [\App\Http\Controllers\Admin\RoleController::class, 'index'])->name('roles.index');
        Route::get('roles/{role}', [\App\Http\Controllers\Admin\RoleController::class, 'show'])->name('roles.show');
        Route::get('roles-data', [\App\Http\Controllers\Admin\RoleController::class, 'getData'])->name('roles.data');
    });

    Route::middleware(['permission:roles.edit'])->group(function() {
        Route::get('roles/{role}/edit', [\App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('roles.edit');
        Route::put('roles/{role}', [\App\Http\Controllers\Admin\RoleController::class, 'update'])->name('roles.update');
        Route::patch('roles/{role}', [\App\Http\Controllers\Admin\RoleController::class, 'update']);
    });

    Route::middleware(['permission:roles.delete'])->group(function() {
        Route::delete('roles/{role}', [\App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('roles.destroy');
    });

    // Permission Management Routes
    Route::middleware(['permission:permissions.create'])->group(function() {
        Route::get('permissions/create', [\App\Http\Controllers\Admin\PermissionController::class, 'create'])->name('permissions.create');
        Route::post('permissions', [\App\Http\Controllers\Admin\PermissionController::class, 'store'])->name('permissions.store');
        Route::get('permissions/assign/role', [\App\Http\Controllers\Admin\PermissionController::class, 'assignRoleForm'])->name('permissions.assign-role-form');
        Route::post('permissions/get-by-role', [\App\Http\Controllers\Admin\PermissionController::class, 'getPermissionsByRole'])->name('permissions.get-by-role');
        Route::post('permissions/assign-to-role', [\App\Http\Controllers\Admin\PermissionController::class, 'assignPermissionsToRole'])->name('permissions.assign-to-role');
    });

    Route::middleware(['permission:permissions.view'])->group(function() {
        Route::get('permissions', [\App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('permissions.index');
        Route::get('permissions/{permission}', [\App\Http\Controllers\Admin\PermissionController::class, 'show'])->name('permissions.show');
        Route::get('permissions-data', [\App\Http\Controllers\Admin\PermissionController::class, 'getData'])->name('permissions.data');
    });

    Route::middleware(['permission:permissions.edit'])->group(function() {
        Route::get('permissions/{permission}/edit', [\App\Http\Controllers\Admin\PermissionController::class, 'edit'])->name('permissions.edit');
        Route::put('permissions/{permission}', [\App\Http\Controllers\Admin\PermissionController::class, 'update'])->name('permissions.update');
        Route::patch('permissions/{permission}', [\App\Http\Controllers\Admin\PermissionController::class, 'update']);
    });

    Route::middleware(['permission:permissions.delete'])->group(function() {
        Route::delete('permissions/{permission}', [\App\Http\Controllers\Admin\PermissionController::class, 'destroy'])->name('permissions.destroy');
    });

    // Toastr Test Routes
    Route::prefix('test')->name('test.')->group(function () {
        Route::get('/toastr', [App\Http\Controllers\Admin\ToastrTestController::class, 'index'])->name('toastr');
        Route::post('/toastr/success', [App\Http\Controllers\Admin\ToastrTestController::class, 'success'])->name('toastr.success');
        Route::post('/toastr/error', [App\Http\Controllers\Admin\ToastrTestController::class, 'error'])->name('toastr.error');
        Route::post('/toastr/info', [App\Http\Controllers\Admin\ToastrTestController::class, 'info'])->name('toastr.info');
        Route::post('/toastr/warning', [App\Http\Controllers\Admin\ToastrTestController::class, 'warning'])->name('toastr.warning');
        Route::post('/toastr/validation', [App\Http\Controllers\Admin\ToastrTestController::class, 'validation'])->name('toastr.validation');
    });
});
require __DIR__.'/auth.php';
