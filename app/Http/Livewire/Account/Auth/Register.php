<?php

namespace App\Http\Livewire\Account\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\Component;

class Register extends Component
{
    public $username, $password, $email, $repeated, $dob, $sex = "m", $terms = false; 

    public function register() {
        if(strlen($this->dob) == 0 || strlen($this->username) == 0 || strlen($this->email) == 0 || strlen($this->password) == 0 || strlen($this->repeated) == 0) {
            toastr()->error('All arguments must to be filled...');
            return;  
        }

        if($this->password != $this->repeated){
            toastr()->error('Password doesn\'t match');
            return; 
        }

        $isEmailInUse = User::where('email', $this->email)->first(); 

        if(!$isEmailInUse) {
            $created = User::create([
                'name'     => $this->username, 
                'email'    => $this->email, 
                'password' => Hash::make($this->password), 
                'dob'      => $this->dob, 
                'sex'      => $this->sex, 
            ]); 
            
            if($created){
                toastr()->success('Account successfully created');
                session()->regenerate(); 
                return redirect()->intended('/'); 
            }
        }
    }

    public function render()
    {
        return view('livewire.account.auth.register');
    }
}
