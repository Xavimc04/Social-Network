<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Category; 
use App\Models\Post; 
use App\Models\User; 
use Illuminate\Pagination\CursorPaginator; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 

class MainController extends Controller
{
    public function get() {
        $posts = Post::all();
        $categories = Category::all(); 

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
    
        return view('main', compact("posts", "categories")); 
    }

    public function action(Request $request) {
        if($request->input('action') == 'like') {
            $post = Post::where('id', $request->input('post_id'))->first(); 

            if($post->likes == null) {
                $likes = array(Auth::user()->id); 
                $post->likes = $likes; 
                $post->update(); 
            } else {
                $decoded = json_decode($post->likes);  
                $counter = 0;  
    
                foreach($decoded as $single_like) {
                    if($single_like == Auth::user()->id) { 
                        return back(); 
                    }

                    $counter++; 
                } 
    
                array_push($decoded, Auth::user()->id); 
                $post->likes = $decoded; 
                $post->update(); 
            }

            return back(); 
        }
    }

    public function createPost(Request $request) {
        if($request->filled('content')) {
            $cat = 0; 

            if($request->input('category') != null) {
                if($request->input('category') != 0) {
                    $cat = $request->input('category'); 
                }
            }

            if($request->file('image')) {
                $image = $request->file('image');  
                $filename = uniqid() . '.' . $image->getClientOriginalExtension(); 
                $image->move(public_path('images/posts/'), $filename);

                Post::create([
                    "user_id" => $request->input('identifier'), 
                    "category_id" => $cat, 
                    "content" => $request->input('content'), 
                    "file_route" => '/images/posts/' . $filename
                ]);
            } else {
                Post::create([
                    "user_id" => $request->input('identifier'), 
                    "category_id" => $cat, 
                    "content" => $request->input('content') 
                ]);
            }
            
            return redirect()->back()->with('success', 'Post created successfully'); 
        }

        return back()->with('error', 'All arguments must to be filled, please, complete it...'); 
    }
}