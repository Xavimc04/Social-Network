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
}