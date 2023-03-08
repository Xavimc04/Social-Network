<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController; 
use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\AuthController;  
use App\Http\Controllers\SettingsController; 
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\ChatController; 

use App\Events\ConnectionHandler; 
use App\Events\WhisperUser; 

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [MainController::class, 'get']);

    // @ Messages 
    Route::get('/chats', [ChatController::class, 'render']);
    Route::get('/chats/{id}', [ChatController::class, 'goChat']);

    // @ Accounts
    Route::get('/account-settings', [SettingsController::class, 'get']);
    Route::get('/profile/{identifier}', function($identifier) {
        $profile = new ProfileController(); 
        return $profile->get($identifier); 
    }); 

    // @ Administrators
    Route::get('/admin/dashboard', [DashboardController::class, 'get']); 
}); 

// @ Delete
Route::get('/whisper', function() {
    broadcast(new WhisperUser(3, 'holaaaa')); 
    return null; 
});

// @ Auth
Route::get('login', [AuthController::class, 'getLogin'])->name('login');
Route::get('register', [AuthController::class, 'getRegister'])->name('register');  
Route::get('logout', [AuthController::class, 'logout']);