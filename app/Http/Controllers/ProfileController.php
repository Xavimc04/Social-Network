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
}
