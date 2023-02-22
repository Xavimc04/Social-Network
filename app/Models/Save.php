<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Save extends Model
{ 
    use HasFactory;
    public $timestamps = false;
    public $table = "saved_posts"; 
    
    protected $fillable = [
        'post_id', 'user_id'
    ];
}
