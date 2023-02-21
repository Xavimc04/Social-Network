<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category; 
use App\Models\User;  
use Illuminate\Support\Facades\Auth; 

class ProfileController extends Controller
{
    public function get($id) {
        $user = User::where('id', $id)->first(); 
        $categories = Category::all();  

        if($user) {
            return view('profile', compact('user', 'categories')); 
        }

        return redirect('/')->with('error', 'This profile does not exist...');
    }

    public function edit(Request $request) {
        if(!$request->filled('name')) {
            toastr()->error('Argument name must to be filled to save profile changes...'); 
            return redirect()->back(); 
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
        
        toastr()->success('Changes has been saved on database...'); 
        return redirect()->back(); 
    }
}
