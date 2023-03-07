<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;

class Chat extends Component
{
    public $search = ""; 

    public function render()
    {
        return view('livewire.account.chat');
    }
}
