<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Chats\Chat;

class ChatMember extends Model
{
    use HasFactory;

    public $table = "chat_members"; 

    public $fillable = [
        'chat_id', 'user_id'
    ]; 

    public function chat() {
        return $this->belongsTo(Chat::class); 
    }
}
