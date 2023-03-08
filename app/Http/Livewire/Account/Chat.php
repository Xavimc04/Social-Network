<?php

namespace App\Http\Livewire\Account;
use Livewire\Component;
use App\Models\User;  
use App\Models\ChatMember; 
use App\Models\ChatMessage;
use App\Models\Chat as SingleChat; 
use Illuminate\Support\Facades\Auth; 
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class Chat extends Component
{
    use WithPagination;

    public $search = "", $perPage = 10, $orderBy = "new"; 

    public function startChat($target_id) { 
        if(Auth::user()->id == $target_id) {
            toastr()->error("You can't start a conversation with yourself..."); 
            return; 
        }
        
        $chat = SingleChat::create([]);

        ChatMember::create([
            "chat_id" => $chat->id, 
            "user_id" => Auth::user()->id
        ]); 

        ChatMember::create([
            "chat_id" => $chat->id, 
            "user_id" => $target_id
        ]); 

        ChatMessage::create([
            "sender_id" => Auth::user()->id, 
            "chat_id" => $chat->id, 
            "message" => '👋'
        ]); 

        $this->search = "";  
    }

    public function render()
    {
        $profiles = [];
        $chats = []; 
        
        if(strlen($this->search) > 0) {
            $profiles = User::where('name', 'like', '%' . $this->search . '%')->skip(0)->take(5)->get(); 
        } 

        $whereIPertain = ChatMember::where('user_id', Auth::user()->id)->paginate($this->perPage);;

        if($this->orderBy == 'new') {
            $whereIPertain = ChatMember::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate($this->perPage);
        } else if($this->orderBy == 'old') {
            $whereIPertain = ChatMember::where('user_id', Auth::user()->id)->orderBy('created_at', 'ASC')->paginate($this->perPage);
        } 
        
        for ($index = 0; $index < $whereIPertain->count(); $index++) { 
            $single = SingleChat::where('id', $whereIPertain[$index]->chat_id)->first();

            $chats[$index] = $single; 
            $chats[$index]->members = $single->members;  

            if(count($single->members) == 2) {
                foreach ($single->members as $member) {
                    if($member->user_id != Auth::user()->id) {
                        $user = User::find($member->user_id); 

                        $chats[$index]->name = $user->name;
                        $chats[$index]->icon = $user->profile_route;
                    }
                }
            }
        }

        return view('livewire.account.chat', [
            "profiles" => $profiles, 
            "whereIPertain" => $whereIPertain,
            "chats" => $chats
        ]);
    }
}
