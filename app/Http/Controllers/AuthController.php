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

    public function authRegister(Request $request) {
        if(!$request->filled('username') || !$request->filled('email') || !$request->filled('password') || !$request->filled('repeated')) {
            return back()->with('error', 'All arguments must to be filled')->withInput(); 
        }

        if($request->input('password') != $request->input('repeated')){
            return back()->with('message', 'Password doesn\'t match')->withInput(); 
        }

        $isEmailInUse = User::where('email', $request->input('email'))->first(); 

        if(!$isEmailInUse) {
            $created = User::create([
                'name'     => $request->input('username'), 
                'email'    => $request->input('email'), 
                'password' => Hash::make($request->input('password'))
            ]); 
            
            if($created){
                $request->session()->regenerate(); 
                return redirect()->intended('/'); 
            }
        }

        return back()->with('error', 'Error while creating your account, try again...'); 
    }

    public function authLogin(Request $request) {
        if( Auth::attempt([
            'email' => $request->input('email'), 
            'password' => $request->input('password')
        ])) {
            $request->session()->regenerate(); 
            return redirect()->intended('/'); 
        };
        
        return back()->with('message', 'This email or password does not exist')->onlyInput('email');
    }
}
