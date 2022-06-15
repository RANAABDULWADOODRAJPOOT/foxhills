<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PropertyType;
use App\Models\agent;
use App;
use Auth;
use DB;
use Session;



class AvailableProperty extends Model
{
    use HasFactory;
   
    const TYPE_ONE = '1';
    const TYPE_TWO  = '2';
     const TYPE_THREE  = '3';
      const TYPE_FOUR  = '4';




      const GET_TYPE = [
        self::TYPE_ONE=> 'Sale',
        self::TYPE_TWO => 'Rent',
         self::TYPE_THREE => 'Curated Projects',
          self::TYPE_FOUR => 'International',
    ];


     protected $fillable = ['productname', 'city', 'area' , 'Description', 'Price', 'Area', 'Bedrooms', 'length', 'Speciality', 'property_type_id', 'picture', 'Category','Completion','status','agent','bannerimage'];  

    public function propertyType()
    {
        return $this->belongsTo(propertyType::class);
    }

     public static function getPropertyType($type) {
          $pagecats =  DB::select('SELECT  heading   FROM  pages where id='.$type );
         foreach($pagecats as $pagecat){
            return $pagecat->heading;
         }
    }

    public static function getallbedrooms() {
           $Bedroomsdata = array();
           $p = AvailableProperty::all();
           foreach ($p as $value) {
             if(in_array($value->Bedrooms , $Bedroomsdata)){
              continue;
             }
             else{
               array_push($Bedroomsdata, $value->Bedrooms);
             }
           }
           return  $Bedroomsdata;
    }

    public static function getpropertytypeinfo($id) {

          $propertytypeinfo = PropertyType::find($id);
          return $propertytypeinfo->title;
    }


    public static function getagentname($id='') {
          $agentdata = agent::find($id);
          if(is_null($agentdata)){
         return 'No Agent Assign';
          }
          else{
            return $agentdata->agentname;
          }
          
    }
   

}



