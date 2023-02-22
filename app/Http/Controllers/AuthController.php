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
            toastr()->error('All arguments must to be filled...');

            return back()->withInput();  
        }

        if($request->input('password') != $request->input('repeated')){
            toastr()->error('Password doesn\'t match');

            return back()->withInput(); 
        }

        $isEmailInUse = User::where('email', $request->input('email'))->first(); 

        if(!$isEmailInUse) {
            $created = User::create([
                'name'     => $request->input('username'), 
                'email'    => $request->input('email'), 
                'password' => Hash::make($request->input('password'))
            ]); 
            
            if($created){
                toastr()->success('Account successfully created');
                $request->session()->regenerate(); 
                return redirect()->intended('/'); 
            }
        }

        return back()->with('error', 'Error while creating your account, try again...'); 
    }

    public function logout() {
        Auth::logout(); 
        toastr()->success('Successfully logged out, see you soon!'); 
        return redirect('/'); 
    }

    public function authLogin(Request $request) {
        if( Auth::attempt([
            'email' => $request->input('email'), 
            'password' => $request->input('password')
        ])) {
            toastr()->success('Successfully logged in'); 
            $request->session()->regenerate(); 
            return redirect()->intended('/'); 
        };
        
        toastr()->error('This email or password does not exist'); 
        return back()->onlyInput('email');
    }
}
