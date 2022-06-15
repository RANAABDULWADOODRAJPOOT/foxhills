<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{


     protected $fillable = ['journal_type', 'journal_title', 'picture', 'Publish_date', 'description'];  

    
    use HasFactory;
}
