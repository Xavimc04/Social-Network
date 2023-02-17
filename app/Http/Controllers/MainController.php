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
        $categories = Category::all();  
        return view('main', compact("categories")); 
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