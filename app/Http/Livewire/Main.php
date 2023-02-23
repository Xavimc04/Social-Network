<?php

namespace App\Http\Livewire;
use App\Models\User;
use App\Models\Post; 
use App\Models\Save; 
use App\Models\Category; 
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth; 

class Main extends Component
{  
    use WithPagination;
    public $search = '';  

    public function updatingSearch() {
        $this->resetPage();
    }

    public function setSearch($content) {
        $this->search = $content;
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

            array_push($decoded, Auth::user()->id); 
            $currentPost->likes = $decoded; 
            $currentPost->update(); 
        }  
    }

    public function render()
    {
        if(str_contains($this->search, '#')){
            $founded_category = Category::where('name', 'like', '%' . str_replace('#', '', $this->search) . '%')->first(); 
            $posts = Post::where('category_id', $founded_category->id)->orderBy('created_at', 'DESC')->paginate(7); 
        } else {
            $posts = Post::where('content', 'like', '%' . $this->search . '%')->orderBy('created_at', 'DESC')->paginate(7); 
        }

        for($index = 0; $index < $posts->count(); $index++) {
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
            "posts" => $posts
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
