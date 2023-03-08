<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Chat;

class ChatMessage extends Model
{
    use HasFactory;

    public $table = "chat_messages";

    public $fillable = [
        'chat_id', 'sender_id', 'message'
    ]; 

    public function chat() {
        return $this->belongsTo(Chat::class); 
    }
}
