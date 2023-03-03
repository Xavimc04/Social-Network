<?php

namespace App\Http\Livewire\Account\Auth;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email, $password; 

    public function access() {
        if( Auth::attempt([
            'email' => $this->email, 
            'password' => $this->password 
        ])) {
            toastr()->success('Successfully logged in'); 
            session()->regenerate(); 
            return redirect()->intended('/'); 
        };
        
        toastr()->error('This email or password does not exist'); 
        return; 
    }

    public function render()
    {
        return view('livewire.account.auth.login');
    }
}
