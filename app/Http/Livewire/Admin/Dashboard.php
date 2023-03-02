<?php

namespace App\Http\Livewire\Admin;
use Livewire\Component;

class Dashboard extends Component
{
    public $selected = 'categories'; 

    public function setPage($val) {
        $this->selected = $val; 
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
