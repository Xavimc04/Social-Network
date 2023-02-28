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

    public function create() {
        if(strlen($this->content) < 10) {
            toastr()->error('Content must be 10 minimum args to be created...'); 
            return; 
        }

        $filename = ""; 

        if($this->image) {
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
    }

    public function render()
    {
        return view('livewire.post.post', [
            "categories" => $this->categories
        ]);
    }
}
