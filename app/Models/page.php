<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\PropertyType;
use App\Models\AvailableProperty;

class page extends Model
{
    use HasFactory;

    const TYPE_ONE = '1';
    const TYPE_TWO  = '2';





      const GET_TYPE = [
        self::TYPE_ONE=> 'Header',
        self::TYPE_TWO => 'Footer'

    ];

     public function properties()
    {
        return $this->hasMany(AvailableProperty::class,'Category','id');
    }

     public static function getlocation($type) {
          return self::GET_TYPE[$type];
    }

    public static function getallheadings() {
          return page::all();
    }
}
