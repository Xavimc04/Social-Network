<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ChatMember; 
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function render() {
        return view('chats'); 
    }

    public function goChat($id) {
        $canAccess = ChatMember::where('chat_id', $id)
        ->where('user_id', Auth::user()->id)
        ->first(); 

        if(!$canAccess) {
            return redirect('/chats'); 
        }        

        return view('conversation'); 
    }
}
