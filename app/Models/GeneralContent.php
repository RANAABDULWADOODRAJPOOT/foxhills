<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralContent extends Model
{
    use HasFactory;

     public function propertyType()
    {
        return $this->belongsTo(propertyType::class);
    }

    protected $fillable = ['productname', 'Description',  'property_type_id', 'picture', 'Category','status']; 
}
