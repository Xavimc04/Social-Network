<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category; 
use App\Models\User; 
use App\Models\Post; 

class ProfileController extends Controller
{
    public function get($id) {
        $user = User::where('id', $id)->first(); 
        $categories = Category::all(); 
        $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->get();

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

        if($user) {
            return view('profile', compact('user', 'posts', 'categories')); 
        }

        return redirect('/')->with('error', 'This profile does not exist...');
    }
}
