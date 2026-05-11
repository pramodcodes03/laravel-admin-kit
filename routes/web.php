<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\InstituteCategoryController;
use App\Http\Controllers\Admin\InstituteController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ListingRequestController;

Route::get('/', fn() => redirect()->route('admin.login'));

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

        Route::resource('users', UserController::class);
        Route::patch('users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');

        Route::resource('cities', CityController::class);
        Route::patch('cities/{id}/toggle-status', [CityController::class, 'toggleStatus'])->name('cities.toggle-status');

        Route::resource('institute-categories', InstituteCategoryController::class);
        Route::patch('institute-categories/{id}/toggle-status', [InstituteCategoryController::class, 'toggleStatus'])->name('institute-categories.toggle-status');

        Route::resource('institutes', InstituteController::class);
        Route::patch('institutes/{id}/toggle-status', [InstituteController::class, 'toggleStatus'])->name('institutes.toggle-status');
        Route::patch('institutes/{id}/toggle-featured', [InstituteController::class, 'toggleFeatured'])->name('institutes.toggle-featured');
        Route::patch('institutes/{id}/toggle-verified', [InstituteController::class, 'toggleVerified'])->name('institutes.toggle-verified');

        Route::resource('courses', CourseController::class);
        Route::patch('courses/{id}/toggle-status', [CourseController::class, 'toggleStatus'])->name('courses.toggle-status');

        Route::resource('inquiries', InquiryController::class)->only(['index', 'show', 'update', 'destroy']);

        Route::resource('blog', BlogController::class);
        Route::patch('blog/{id}/toggle-status', [BlogController::class, 'toggleStatus'])->name('blog.toggle-status');

        Route::resource('listing-requests', ListingRequestController::class)->only(['index', 'show', 'update', 'destroy']);
    });
});
