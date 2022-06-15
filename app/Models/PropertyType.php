<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App;
use Auth;
use DB;
use Session;

use App\Models\PropertyType;

class PropertyType extends Model
{
    use HasFactory;


    public static function getPropertyTypes() {
           return  DB::select('SELECT title,id FROM  property_types');
    }

    public static function getpropertytypeofheading($id) {
          $getpropertytypeofheading =  PropertyType::find($id);
          return $getpropertytypeofheading; 
    }

    public static function getpropertytypeviaid($id) {
          $getpropertytypeviaid =  PropertyType::find($id);
          return $getpropertytypeviaid->title ; 
    }



}
