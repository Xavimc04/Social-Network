<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChatMember; 
use App\Models\ChatMessage;

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
        return $this->hasMany(ChatMessage::class)->orderBy('created_at', 'ASC'); 
    }
}
