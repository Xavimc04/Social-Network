<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getLogin() {
        return view('auth/login');
    }

    public function getRegister() {
        return view('auth/register');
    }

    public function logout() {
        Auth::logout(); 
        session()->invalidate();
        session()->regenerateToken();
        toastr()->info('Successfully logged out, see you soon!'); 
        return redirect('/'); 
    } 
}
