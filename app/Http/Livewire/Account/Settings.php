<?php

namespace App\Http\Livewire\Account;
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 
use Livewire\WithFileUploads;
use Livewire\Component;

class Settings extends Component
{
    use WithFileUploads;

    public $user, $name, $editing_name = false, $image;

    public function mount() {
        $this->user = Auth::user(); 
        $this->name = $this->user->name; 
    }

    function validateExtension() {
        $available_formats = ['jpg', 'jpeg', 'png', 'gif', 'webp']; 

        foreach ($available_formats as $format) {
            if($this->image->getClientOriginalExtension() == $format) {
                return true;  
            }
        } 

        toastr()->error('Your post can\'t be created, the image has incorrect format, please, check it.'); 
        return false;  
    }

    public function save() {
        if(strlen($this->name) >= 5) {
            if($this->name != Auth::user()->name) {  
                $this->user->name = $this->name; 
                $this->user->update(); 

                $this->editing_name = false; 
            } 
        } else {
            toastr()->error("Invalid format for name field, please, type again..."); 
        }

        $filename = ""; 

        if($this->image) { 
            if(!$this->validateExtension()) {
                return; 
            } 
            
            $this->filename = uniqid(); 
            $this->image->storeAs('images/profiles', $this->filename . '.' . $this->image->getClientOriginalExtension(), 'real_public'); 
            $this->user->profile_route = '/images/profiles/' . $this->filename . '.' . $this->image->getClientOriginalExtension(); 
            $this->user->update(); 
        }

        toastr()->success("All changes has been stored on database...");  
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
