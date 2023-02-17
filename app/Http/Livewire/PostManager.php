<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth; 

class PostManager extends Component
{
    public $post; 

    public function like() {
        $currentPost = Post::where('id', $this->post->id)->first(); 

        if($currentPost->likes == null) {
            $likes = array(Auth::user()->id); 
            $currentPost->likes = $likes; 
            $currentPost->update(); 
        } else {
            $decoded = json_decode($currentPost->likes);  
            $counter = 0;  

            foreach($decoded as $single_like) {
                if($single_like == Auth::user()->id) { 
                    return; 
                }

                $counter++; 
            } 

            array_push($decoded, Auth::user()->id); 
            $currentPost->likes = $decoded; 
            $currentPost->update(); 
        }

        $this->post = $currentPost;  
    }

    public function mount($post) {
        $this->post = $post; 
    }

    public function render() {
        return view('livewire.post-manager');
    }
}
