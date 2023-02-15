<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category; 
use App\Models\User; 
use App\Models\Post; 
use App\Models\Follower; 
use Illuminate\Support\Facades\Auth; 

class ProfileController extends Controller
{
    public function get($id) {
        $user = User::where('id', $id)->first(); 
        $categories = Category::all(); 
        $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        $following = Follower::where('user_id', $id)->where('follower', Auth::user()->id)->first();
        $followers = Follower::where('user_id', $id)->get(); 

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
            return view('profile', compact('user', 'posts', 'categories', 'following', 'followers')); 
        }

        return redirect('/')->with('error', 'This profile does not exist...');
    }

    public function edit(Request $request) {
        if(!$request->filled('name')) {
            return redirect()->back()->with('error', 'Argument name must to be filled...'); 
        }

        $user = User::where('id', Auth::user()->id)->first(); 

        if($user->name != $request->input('name')) {
            $user->name = $request->input('name'); 
            $user->update(); 
        }

        if($request->file('image')) {
            $image = $request->file('image');  
            $filename = uniqid() . '.' . $image->getClientOriginalExtension(); 
            $image->move(public_path('images/profiles/'), $filename);

            $user->profile_route = '/images/profiles/' . $filename; 
            $user->update(); 
        }
        

        return redirect()->back(); 
    }
}
