<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelUserRole extends Model
{
    use HasFactory;
    
    public $timestamps = false; 
    public $table = "rel_user_role"; 

    protected $fillable = [
        'user_id', 'role_id'
    ]; 
}
