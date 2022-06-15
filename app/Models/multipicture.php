<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class multipicture extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'picture'];  
}
