<?php

namespace App\Http\Livewire;
use App\Models\Category; 
use App\Models\User; 
use App\Models\Post; 
use App\Models\Follower; 
use Illuminate\Support\Facades\Auth; 
use Livewire\Component;

class Profile extends Component
{
    public $profile_id, $following, $followers; 

    public function mount($id) {
        $this->profile_id = $id;  
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
        $user = User::where('id', $this->profile_id)->first(); 
        $categories = Category::all(); 
        $posts = Post::where('user_id', $this->profile_id)->orderBy('created_at', 'desc')->get();
        $this->following = Follower::where('user_id', $this->profile_id)->where('follower', Auth::user()->id)->first();
        $this->followers = Follower::where('user_id', $this->profile_id)->get(); 

        for($index = 0; $index < $posts->count(); $index++) {
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

        return view('livewire.profile', [
            "user" => $user, 
            "posts" => $posts, 
            "categories" => $categories, 
            "following" => $this->following, 
            "followers" => $this->followers
        ]);
    }
}
