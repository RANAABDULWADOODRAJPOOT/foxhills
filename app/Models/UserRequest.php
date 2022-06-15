<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{

     protected $fillable = ['name', 'email', 'phone' , 'description', 'user_request_type'];  
    use HasFactory;
}
