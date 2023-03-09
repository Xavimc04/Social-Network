<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\ChatMember; 
use App\Models\Chat as SingleChat; 
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

        $current_chat = SingleChat::find($id); 

        $conversation = $current_chat; 
        $conversation->members = $current_chat->members;  

        if(count($current_chat->members) == 2) {
            foreach ($current_chat->members as $member) {
                if($member->user_id != Auth::user()->id) {
                    $user = User::find($member->user_id); 

                    $conversation->name = $user->name;
                    $conversation->icon = $user->profile_route;
                }
            }
        }

        return view('conversation', [
            "conversation" => $conversation
        ]); 
    }
}
