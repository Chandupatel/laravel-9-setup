<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Auth\Admin\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/forgot-password', [LoginController::class, 'submitForgotPassword'])->name('forgot-password');
Route::get('/reset-password/{token}', [LoginController::class, 'resetPassword'])->name('reset-password');
Route::post('/submit-reset-password', [LoginController::class, 'submitResetPassword'])->name('submit-reset-password');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['admin'])->group(function () {
    //Dashboard Route
    Route::get('/', [HomeController::class, 'dashboard'])->name('index');
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    //Profile Route
    Route::post('/upload-profile-image', [HomeController::class, 'uploadProfileImage'])->name('upload-profile-image');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::post('/profile', [HomeController::class, 'updateProfile'])->name('profile');
    Route::post('/update-password', [HomeController::class, 'updatePassword'])->name('update-password');

    Route::prefix('settings')->group(function () {
        Route::name('settings.')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->name('index');
            Route::get('/create', [SettingController::class, 'create'])->name('create');
            Route::post('/store', [SettingController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [SettingController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [SettingController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [SettingController::class, 'destroy'])->name('destroy');
            Route::get('/group/{group}', [SettingController::class, 'settingsGroup'])->name('group');
        });
    });

    Route::prefix('modules')->group(function () {
        Route::name('modules.')->group(function () {
            Route::get('/', [ModuleController::class, 'index'])->name('index');
            Route::get('/create', [ModuleController::class, 'create'])->name('create');
            Route::post('/store', [ModuleController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ModuleController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [ModuleController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [ModuleController::class, 'destroy'])->name('destroy');
        });
    });
});
