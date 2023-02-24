<?php

namespace App\Http\Livewire\Account;
use Illuminate\Support\Facades\Auth; 
use Livewire\Component;

class Settings extends Component
{
    public function render()
    {
        return view('livewire.account.settings');
    }
}
