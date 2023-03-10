<?php

namespace App\Http\Livewire\Account;
use Livewire\Component;
use App\Events\ChatMessage;
use App\Models\Chat as SingleChat; 
use App\Models\ChatMessage as Messages; 
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 

class Conversation extends Component
{
    public $conversation = [], $conversation_id, $input = ""; 

    public function mount($conversation_id) { 
        $this->conversation_id = $conversation_id; 
    }

    public function sendMessage() {
        if(strlen($this->input) > 0) {
            $chat = SingleChat::find($this->conversation->id); 

            $message = Messages::create([
                "sender_id" => Auth::user()->id,
                "chat_id" => $chat->id, 
                "message" => $this->input
            ]); 

            $this->input = "";  
            broadcast(new ChatMessage($message, $this->conversation->id))->toOthers(); 
        }
    }

    public function render()
    {
        $this->conversation = SingleChat::find($this->conversation_id);

        $this->conversation->messages = $this->conversation
        ->messages()
        ->orderBy('created_at', 'asc')    
        ->get();

        if(count($this->conversation->members) == 2) {
            foreach ($this->conversation->members as $member) {
                if($member->user_id != Auth::user()->id) {
                    $user = User::find($member->user_id); 

                    $this->conversation->name = $user->name;
                    $this->conversation->icon = $user->profile_route;
                }
            }
        }

        return view('livewire.account.conversation');
    }
}
