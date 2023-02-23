<?php

namespace App\Http\Livewire;
use App\Models\Category; 
use App\Models\User; 
use App\Models\Post; 
use App\Models\Save; 
use App\Models\Follower; 
use Illuminate\Support\Facades\Auth; 
use Livewire\Component;

class Profile extends Component
{
    public $profile_id, $following, $followers, $posts_view = "profile"; 

    public function mount($id) {
        $this->profile_id = $id;  
    }

    public function handlePostView() {
        if($this->posts_view == "profile") {
            $this->posts_view = "saved"; 
        } else {
            $this->posts_view = "profile";
        }
    }

    public function handleFollow() {
        $follow = Follower::where('user_id', $this->profile_id)
        ->where('follower', Auth::user()->id)
        ->first(); 

        if($follow) {
            $follow->delete(); 
            toastr()->info('Unfollow saved successfully'); 
        } else {
            Follower::create([
                "follower" => Auth::user()->id, 
                "user_id"  => $this->profile_id
            ]); 

            toastr()->success('Now you\'re currently following to this profile!');
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

            array_push($decoded, Auth::user()->id); 
            $currentPost->likes = $decoded; 
            $currentPost->update(); 
        }  
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

    public function render()
    {
        $user = User::where('id', $this->profile_id)->first(); 
        $categories = Category::all();  
        
        if($this->posts_view == 'saved') {
            $saved = Save::where('user_id', Auth::user()->id)->get(); 
            $posts = array();  

            foreach($saved as $current) {
                $getted_post = Post::where('id', $current->post_id)->first(); 

                if($getted_post) { 
                    array_push($posts, $getted_post); 
                }
            } 
        } else {
            $posts = Post::where('user_id', $this->profile_id)->orderBy('created_at', 'desc')->get(); 
        } 

        $this->following = Follower::where('user_id', $this->profile_id)->where('follower', Auth::user()->id)->first();
        $this->followers = Follower::where('user_id', $this->profile_id)->get(); 

        for($index = 0; $index < count($posts); $index++) {
            $creator = User::where('id', $posts[$index]->user_id)->first(); 

            if($creator) { 
                $posts[$index]->user = $creator; 
            } 

            $isSaved = Save::where('post_id', $posts[$index]->id)
            ->where('user_id', Auth::user()->id)
            ->first(); 

            if($isSaved) {
                $posts[$index]->is_saved = true;  
            } else {
                $posts[$index]->is_saved = false; 
            }

            if($posts[$index]->likes != null) {
                $likes = json_decode($posts[$index]->likes); 
                $posts[$index]->likes = $likes; 
            } else {
                $posts[$index]->likes = 0; 
            }
        }

        return view('livewire.profile', [
            "user" => $user, 
            "posts" => $posts, 
            "categories" => $categories, 
            "following" => $this->following, 
            "followers" => $this->followers, 
            "posts_view" => $this->posts_view
        ]);
    }
}
