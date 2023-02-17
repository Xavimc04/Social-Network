<?php

namespace App\Http\Livewire;
use App\Models\User;
use App\Models\Post; 
use Livewire\Component;
use Livewire\WithPagination;

class Main extends Component
{  
    use WithPagination;
    public $search = '';  

    public function updatingSearch() {
        $this->resetPage();
    }

    public function render()
    {
        $posts = Post::where('content', 'like', '%' . $this->search . '%')->orderBy('created_at', 'DESC')->paginate(7); 

        for($index = 0; $index < $posts->count(); $index++) {
            $user = User::where('id', $posts[$index]->user_id)->first();
            
            if($user) {
                $posts[$index]->user = $user; 
            } 

            if($posts[$index]->likes != null) {
                $likes = json_decode($posts[$index]->likes); 
                $posts[$index]->likes = $likes; 
            } else {
                $posts[$index]->likes = 0; 
            }
        }

        return view('livewire.main', [
            "posts" => $posts
        ]);
    }
}
