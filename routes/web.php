<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController; 
use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\FollowerController; 

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [MainController::class, 'get']);

    Route::post('/post/create', [MainController::class, 'createPost'])->name('post.new'); 

    Route::post('/post/action', [MainController::class, 'action'])->name('post.action'); 

    Route::get('/profile/{identifier}', function($identifier) {
        $profile = new ProfileController(); 
        return $profile->get($identifier); 
    }); 

    Route::post('/profile/handle', [FollowerController::class, 'handle'])->name('follow');
    Route::post('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
}); 

Route::get('login', [AuthController::class, 'getLogin'])->name('login');
Route::get('register', [AuthController::class, 'getRegister'])->name('register'); 

Route::post('login', [AuthController::class, 'authLogin'])->name('auth.login'); 
Route::post('register', [AuthController::class, 'authRegister'])->name('auth.register');
