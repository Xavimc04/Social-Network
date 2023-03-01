<?php

namespace App\Http\Livewire\Post;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Auth; 
use App\Models\Post as Posts; 

class Post extends Component
{
    use WithFileUploads;

    public $content, $categories, $initialized = false, $image, $category = 0;

    protected $listeners = [
        'editorUpdated' => 'updateValue',
    ];

    public function mount($categories) { 
        $this->initialized = true;
        $this->categories = $categories; 
    }

    public function updateValue($value) {
        if ($this->initialized) {
            $this->content = $value; 
        }
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

    public function create() {
        if(strlen($this->content) < 10) {
            toastr()->error('Content must be 10 minimum args to be created...'); 
            return; 
        }

        $filename = ""; 

        if($this->image) { 
            if(!$this->validateExtension()) {
                return; 
            }

            $this->filename = uniqid(); 
            $this->image->storeAs('images/posts', $this->filename . '.' . $this->image->getClientOriginalExtension(), 'real_public'); 
            
            Posts::create([
                "user_id" => Auth::user()->id, 
                "category_id" => $this->category, 
                "content" => $this->content, 
                "file_route" => '/images/posts/' . $this->filename . '.' . $this->image->getClientOriginalExtension()
            ]);
        } else {
            Posts::create([
                "user_id" => Auth::user()->id, 
                "category_id" => $this->category, 
                "content" => $this->content, 
            ]);
        }

        toastr()->success('Post successfully created!'); 
        // @ Reset content 
        $this->content = ""; 
        // @ Livewire components event
        $this->emit('post-created'); 
        // @ Javascript event
        $this->dispatchBrowserEvent('post-created');
    }

    public function render()
    {
        return view('livewire.post.post', [
            "categories" => $this->categories
        ]);
    }
}
