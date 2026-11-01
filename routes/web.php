<?php

use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [LoginController::class, 'create'])->name('login');
    Route::post('/admin/login', [LoginController::class, 'store'])->middleware('throttle:5,1')->name('login.store');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::get('/profile', [SettingController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [SettingController::class, 'update'])->name('profile.update');

    Route::get('/password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('/skills/{skill}/move', [SkillController::class, 'move'])->name('skills.move');
    Route::resource('skills', SkillController::class)->except(['show']);

    Route::post('/experiences/{experience}/move', [ExperienceController::class, 'move'])->name('experiences.move');
    Route::resource('experiences', ExperienceController::class)->except(['show']);

    Route::post('/projects/{project}/move', [ProjectController::class, 'move'])->name('projects.move');
    Route::resource('projects', ProjectController::class)->except(['show']);

    Route::post('/certificates/{certificate}/move', [CertificateController::class, 'move'])->name('certificates.move');
    Route::resource('certificates', CertificateController::class)->except(['show']);
});
