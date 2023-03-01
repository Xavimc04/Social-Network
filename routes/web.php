<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController; 
use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\AuthController;  
use App\Http\Controllers\SettingsController; 
use App\Http\Controllers\DashboardController; 

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [MainController::class, 'get']);

    // @ Accounts
    Route::get('/account-settings', [SettingsController::class, 'get']);
    Route::get('/profile/{identifier}', function($identifier) {
        $profile = new ProfileController(); 
        return $profile->get($identifier); 
    }); 

    // @ Information
    Route::get('/app/help', [MainController::class, 'get']);
    Route::get('/app/contact-support', [MainController::class, 'get']);
    Route::get('/app/about-us', [MainController::class, 'get']); 

    // @ Administrators
    Route::get('/admin/dashboard', [DashboardController::class, 'get']); 
}); 

// @ Auth
Route::get('login', [AuthController::class, 'getLogin'])->name('login');
Route::get('register', [AuthController::class, 'getRegister'])->name('register'); 
Route::post('login', [AuthController::class, 'authLogin'])->name('auth.login'); 
Route::post('register', [AuthController::class, 'authRegister'])->name('auth.register');
Route::get('logout', [AuthController::class, 'logout']);
