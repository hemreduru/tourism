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
Route::get('test', function () {
    return view('theme.test');
})->name('test');
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Routes
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // Profile routes
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [UserProfileController::class, 'updatePassword'])->name('profile.update-password');

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

    // About Us Management Routes
    Route::middleware(['permission:about_us.create'])->group(function() {
        Route::get('about-us/create', [\App\Http\Controllers\Admin\AboutUsController::class, 'create'])->name('about_us.create');
        Route::post('about-us', [\App\Http\Controllers\Admin\AboutUsController::class, 'store'])->name('about_us.store');
    });

    Route::middleware(['permission:about_us.view'])->group(function() {
        Route::get('about-us', [\App\Http\Controllers\Admin\AboutUsController::class, 'index'])->name('about_us.index');
        Route::get('about-us/{aboutUs}', [\App\Http\Controllers\Admin\AboutUsController::class, 'show'])->name('about_us.show');
        Route::get('about-us-data', [\App\Http\Controllers\Admin\AboutUsController::class, 'getData'])->name('about_us.data');
    });

    Route::middleware(['permission:about_us.edit'])->group(function() {
        Route::get('about-us/{aboutUs}/edit', [\App\Http\Controllers\Admin\AboutUsController::class, 'edit'])->name('about_us.edit');
        Route::put('about-us/{aboutUs}', [\App\Http\Controllers\Admin\AboutUsController::class, 'update'])->name('about_us.update');
        Route::patch('about-us/{aboutUs}', [\App\Http\Controllers\Admin\AboutUsController::class, 'update']);
    });

    Route::middleware(['permission:about_us.delete'])->group(function() {
        Route::delete('about-us/{aboutUs}', [\App\Http\Controllers\Admin\AboutUsController::class, 'destroy'])->name('about_us.destroy');
    });

    // Service Management Routes
    Route::middleware(['permission:services.create'])->group(function() {
        Route::get('services/create', [\App\Http\Controllers\Admin\ServiceController::class, 'create'])->name('services.create');
        Route::post('services', [\App\Http\Controllers\Admin\ServiceController::class, 'store'])->name('services.store');
    });

    Route::middleware(['permission:services.view'])->group(function() {
        Route::get('services', [\App\Http\Controllers\Admin\ServiceController::class, 'index'])->name('services.index');
        Route::get('services/{service}', [\App\Http\Controllers\Admin\ServiceController::class, 'show'])->name('services.show');
        Route::get('services-data', [\App\Http\Controllers\Admin\ServiceController::class, 'index'])->name('services.data');
    });

    Route::middleware(['permission:services.edit'])->group(function() {
        Route::get('services/{service}/edit', [\App\Http\Controllers\Admin\ServiceController::class, 'edit'])->name('services.edit');
        Route::put('services/{service}', [\App\Http\Controllers\Admin\ServiceController::class, 'update'])->name('services.update');
        Route::patch('services/{service}', [\App\Http\Controllers\Admin\ServiceController::class, 'update']);
    });

    Route::middleware(['permission:services.delete'])->group(function() {
        Route::delete('services/{service}', [\App\Http\Controllers\Admin\ServiceController::class, 'destroy'])->name('services.destroy');
    });

    // Partner Management Routes
    Route::middleware(['permission:partners.create'])->group(function() {
        Route::get('partners/create', [\App\Http\Controllers\Admin\PartnerController::class, 'create'])->name('partners.create');
        Route::post('partners', [\App\Http\Controllers\Admin\PartnerController::class, 'store'])->name('partners.store');
    });

    Route::middleware(['permission:partners.view'])->group(function() {
        Route::get('partners', [\App\Http\Controllers\Admin\PartnerController::class, 'index'])->name('partners.index');
        Route::get('partners/{partner}', [\App\Http\Controllers\Admin\PartnerController::class, 'show'])->name('partners.show');
        Route::get('partners-data', [\App\Http\Controllers\Admin\PartnerController::class, 'index'])->name('partners.data');
    });

    Route::middleware(['permission:partners.edit'])->group(function() {
        Route::get('partners/{partner}/edit', [\App\Http\Controllers\Admin\PartnerController::class, 'edit'])->name('partners.edit');
        Route::put('partners/{partner}', [\App\Http\Controllers\Admin\PartnerController::class, 'update'])->name('partners.update');
        Route::patch('partners/{partner}', [\App\Http\Controllers\Admin\PartnerController::class, 'update']);
    });

    Route::middleware(['permission:partners.delete'])->group(function() {
        Route::delete('partners/{partner}', [\App\Http\Controllers\Admin\PartnerController::class, 'destroy'])->name('partners.destroy');
    });

    // Contact Management Routes
    Route::middleware(['permission:contacts.create'])->group(function() {
        Route::get('contacts/create', [\App\Http\Controllers\Admin\ContactController::class, 'create'])->name('contacts.create');
        Route::post('contacts', [\App\Http\Controllers\Admin\ContactController::class, 'store'])->name('contacts.store');
    });

    Route::middleware(['permission:contacts.view'])->group(function() {
        Route::get('contacts', [\App\Http\Controllers\Admin\ContactController::class, 'index'])->name('contacts.index');
        Route::get('contacts/{contact}', [\App\Http\Controllers\Admin\ContactController::class, 'show'])->name('contacts.show');
        Route::get('contacts-data', [\App\Http\Controllers\Admin\ContactController::class, 'index'])->name('contacts.data');
    });

    Route::middleware(['permission:contacts.edit'])->group(function() {
        Route::get('contacts/{contact}/edit', [\App\Http\Controllers\Admin\ContactController::class, 'edit'])->name('contacts.edit');
        Route::put('contacts/{contact}', [\App\Http\Controllers\Admin\ContactController::class, 'update'])->name('contacts.update');
        Route::patch('contacts/{contact}', [\App\Http\Controllers\Admin\ContactController::class, 'update']);
    });

    Route::middleware(['permission:contacts.delete'])->group(function() {
        Route::delete('contacts/{contact}', [\App\Http\Controllers\Admin\ContactController::class, 'destroy'])->name('contacts.destroy');
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
    Route::prefix('test')->name('test.')->middleware(['permission:test.test'])->group(function () {
        Route::get('/toastr', [App\Http\Controllers\Admin\ToastrTestController::class, 'index'])->name('toastr');
        Route::post('/toastr/success', [App\Http\Controllers\Admin\ToastrTestController::class, 'success'])->name('toastr.success');
        Route::post('/toastr/error', [App\Http\Controllers\Admin\ToastrTestController::class, 'error'])->name('toastr.error');
        Route::post('/toastr/info', [App\Http\Controllers\Admin\ToastrTestController::class, 'info'])->name('toastr.info');
        Route::post('/toastr/warning', [App\Http\Controllers\Admin\ToastrTestController::class, 'warning'])->name('toastr.warning');
        Route::post('/toastr/validation', [App\Http\Controllers\Admin\ToastrTestController::class, 'validation'])->name('toastr.validation');
    });

    // User Preferences Routes
    Route::get('/preferences', [App\Http\Controllers\Admin\UserPreferenceController::class, 'edit'])->name('preferences.edit');
    Route::put('/preferences', [App\Http\Controllers\Admin\UserPreferenceController::class, 'update'])->name('preferences.update');

    // Summernote Upload Routes
    Route::post('/summernote/upload-image', [App\Http\Controllers\Admin\SummernoteUploadController::class, 'uploadImage'])->name('summernote.upload-image');
});
require __DIR__.'/auth.php';
