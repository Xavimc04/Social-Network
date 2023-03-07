<?php

namespace App\Http\Livewire;
use App\Models\User;
use App\Models\Post; 
use App\Models\Save; 
use App\Models\Category; 
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth; 

use App\Events\WhisperUser; 

class Main extends Component
{  
    use WithPagination;
    public $search = '', $perPage = 10, $filter_type = "posts"; 

    protected $listeners = [
        'post-created' => 'updatingSearch'
    ];  

    public function updatingSearch() {
        $this->resetPage();
    }

    public function filterByType($type) {
        $this->filter_type = $type; 
    }

    public function setSearch($content, $type) {
        $this->search = $content;

        if($type) {
            $this->filterByType($type); 
        }
    }

    public function save($post_id) {
        $currentPost = Post::where('id', $post_id)->first(); 

        if($currentPost) {
            $doesRelationExist = Save::where('post_id', $post_id)
            ->where('user_id', Auth::user()->id)
            ->first(); 

            if(!$doesRelationExist) {
                Save::create([
                    "user_id" => Auth::user()->id,
                    "post_id" => $post_id 
                ]); 

                toastr()->success('Post has been saved');
            } else {
                $doesRelationExist->delete(); 
                toastr()->info('Post has been unsaved'); 
            }
        }
    }

    public function like($post_id) {
        $currentPost = Post::where('id', $post_id)->first(); 

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

            event(new WhisperUser($currentPost->user_id, Auth::user()->name . ' liked your post...'));
            array_push($decoded, Auth::user()->id); 
            $currentPost->likes = $decoded; 
            $currentPost->update(); 
        }  
    }

    public function render()
    {
        $profiles = null; 
        $categories = []; 
        $posts = []; 

        if($this->filter_type == "categories"){
            $founded_category = Category::where('name', 'like', '%' . $this->search . '%')->first(); 
            $categories = Category::all(); 

            if($founded_category) {
                $posts = Post::where('category_id', $founded_category->id)->orderBy('created_at', 'DESC')->paginate($this->perPage); 
            }
        } elseif($this->filter_type == "profiles") {
            $profiles = User::where('name', 'like', '%' . $this->search . '%')->get();
        } else {
            $posts = Post::where('content', 'like', '%' . $this->search . '%')->orderBy('created_at', 'DESC')->paginate($this->perPage); 
        }

        for($index = 0; $index < count($posts); $index++) {
            $user = User::where('id', $posts[$index]->user_id)->first();
            
            if($posts[$index]->category_id != 0) {
                $cat = Category::where('id', $posts[$index]->category_id)->first(); 

                if($cat) {
                    $posts[$index]->category_name = $cat->name; 
                }
            }

            $isSaved = Save::where('post_id', $posts[$index]->id)
            ->where('user_id', Auth::user()->id)
            ->first(); 

            if($isSaved) {
                $posts[$index]->is_saved = true;  
            } else {
                $posts[$index]->is_saved = false; 
            }
            
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
            "posts" => $posts, 
            "profiles" => $profiles, 
            "categories" => $categories, 
            "filter_type" => $this->filter_type,  
        ]);
    }

    public function delete($post_id)
    {
        $post = Post::where('id', $post_id)->first(); 

        if($post) {
            $saves = Save::where('post_id', $post_id)->get();
            
            foreach($saves as $save) {
                $save->delete(); 
            }

            $post->delete();
        }
    }
}
