<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Chats\ChatMember; 
use App\Models\Chats\ChatMessage;

class Chat extends Model
{
    use HasFactory;

    public $table = "chats"; 

    public $fillable = [
        'name', 'icon', 'administrator'
    ]; 

    public function members() {
        return $this->hasMany(ChatMember::class); 
    }

    public function messages() {
        return $this->hasMany(ChatMessage::class); 
    }
}
