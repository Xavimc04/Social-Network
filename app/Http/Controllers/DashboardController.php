<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RelUserRole as UserRoles; 
use App\Models\Role; 
use App\Models\Category;  
use App\Models\Post; 
use App\Models\User; 

class DashboardController extends Controller
{
    public function get() {
        $user_roles = UserRoles::where('user_id', Auth::user()->id)->get(); 
        $hasPerms = false; 

        foreach($user_roles as $role) {
            $single_role = Role::where('id', $role->role_id)->first(); 

            if($single_role) {
                if($single_role->permissions) {
                    $hasPerms = true; 
                }
            }
        }

        if(!$hasPerms) {
            toastr()->error('You don\'t have permissions to access this route.'); 
            return redirect('/'); 
        } 

        return view('dashboard', [
            "categories" => Category::count(), 
            "users" => User::count(), 
            "posts" => Post::count(),
            "reports" => 0, 
            "advertisemens" => 0, 
            "sessions" => 0,
        ]); 
    }
}
