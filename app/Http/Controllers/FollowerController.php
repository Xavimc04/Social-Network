<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 
use App\Models\Follower; 

class FollowerController extends Controller
{
    public function handle(Request $request) {
        if($request->input('id')) {
            $following = Follower::where('user_id', $request->input('id'))
            ->where('follower', Auth::user()->id)
            ->first(); 

            if($following) {
                $following->delete(); 
            } else {
                Follower::create([
                    "follower" => Auth::user()->id, 
                    "user_id"  => $request->input("id")
                ]); 
            }
        }

        return redirect()->back(); 
    }
}
