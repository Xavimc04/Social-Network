<?php

namespace App\Http\Livewire\Account;
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 
use Livewire\Component;

class Settings extends Component
{
    public $name, $editing_name = false;

    public function mount() {
        $this->name = Auth::user()->name; 
    }

    public function save($type) {
        if($type == 'name') {
            if(strlen($this->name) >= 5) {
                if($this->name != Auth::user()->name){ 
                    $user = User::where('id', Auth::user()->id)->first(); 
                    $user->name = $this->name; 
                    $user->update(); 

                    $this->editing_name = false; 
                }

                toastr()->success("Name has been successfully updated"); 
                return; 
            }
        }

        toastr()->error("Invalid format for name field, please, type again..."); 
    }

    public function handleEdit() {
        $this->editing_name = !$this->editing_name; 
    }

    public function render()
    {
        return view('livewire.account.settings', [
            "editing_name" => $this->editing_name
        ]);
    }
}
