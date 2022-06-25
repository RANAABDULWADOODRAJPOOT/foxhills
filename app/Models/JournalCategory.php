<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalCategory extends Model
{
    use HasFactory;

     public function propertyType()
    {
        return $this->belongsTo(propertyType::class);
    }

    protected $fillable = ['name']; 
}
