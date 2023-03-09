<?php

namespace App\Http\Livewire\Account;
use Livewire\Component;
use App\Events\ChatMessage;
use App\Models\Chat as SingleChat; 
use App\Models\ChatMessage as Messages; 
use Illuminate\Support\Facades\Auth; 

class Conversation extends Component
{
    public $conversation, $input = ""; 

    public function mount($conversation) { 
        $this->conversation = $conversation; 
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
            broadcast(new ChatMessage($message))->toOthers(); 
        }
    }

    public function render()
    {
        return view('livewire.account.conversation');
    }
}
