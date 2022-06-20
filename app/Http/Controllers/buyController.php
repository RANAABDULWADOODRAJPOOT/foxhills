<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use Auth;
use DB;
use Session;

use App\Models\PropertyType; 
use App\Models\AvailableProperty; 
use App\Models\Journal; 
use App\Models\page; 
class buyController extends Controller
{
    function index(){
     
        $userproducts = AvailableProperty::where('Category',1)->with('propertyType')->paginate(9);
        $allPropertyTypes = PropertyType::all();
        $Journals = Journal::take(3)->get();
        return view('Buy',compact('userproducts','allPropertyTypes','Journals'));
    }

    function detail($id){
       
        $userProducts = AvailableProperty::where('id',$id)->with('propertyType')->first();
           $Journals = Journal::take(3)->get();
        return view('product_detail',compact('userProducts','Journals'));
}


function filterviatype(Request $request){
        
if($request->Category=="undefined" || $request->Category==0){
    $request->Category=0;

}
if($request->propertytypeid=="undefined" || $request->propertytypeid==0){
    $request->propertytypeid=0;
}
if($request->Bedrooms=="undefined"){
    $request->Bedrooms=0;
}

if($request->maxsize=="undefined"){
    $request->maxsize=0;
}
if($request->minsize=="undefined"){
    $request->minsize=0;
}
if($request->maxprice=="undefined"){
    $request->maxprice=0;
}
if($request->minprice=="undefined"){
    $request->minprice=0;
}

$t=0;


if($request->Category!=0){
    $t=1;

}elseif($request->propertytypeidCategory!=0){
    $t=2;
}
   

        $a='';
        $b='';
        $c='';
        $d='';
        $e='';
        


        if($request->Category != 0){
            $a =  'Category=' . $request->Category;
        }


      if($a != ''){
              
            if($request->propertytypeid != 0){
                $b =  ' and property_type_id=' . $request->propertytypeid;
                }
        }
        else{
             if($request->propertytypeid != 0){
                $b =  ' property_type_id=' . $request->propertytypeid;
              
            }
        }











        if($b != '' || $a != ''  ){
            if($request->minsize != 0 || $request->minsize != 0){
                $c =  ' and length BETWEEN ' . $request->minsize . ' and ' . $request->maxsize ;
            }
        }
        else{
            if($request->minsize != 0 || $request->minsize != 0){
                $c =  ' length BETWEEN ' . $request->minsize . ' and ' . $request->maxsize ;
            }
        }
   
        
        if($c != '' || $b != '' || $a != ''){       
            if($request->Bedrooms != 0){
                $d =  ' and Bedrooms=' . $request->Bedrooms;
            }
        }
        else{
            if($request->Bedrooms != 0){
                    $d =  ' Bedrooms=' . $request->Bedrooms;
            }
        }


        

       

        if($d != '' || $c != '' || $b != '' || $a != ''){
            if($request->minprice != 0 || $request->maxprice != 0){
                $e =  ' and price BETWEEN ' . $request->minprice . ' and ' . $request->maxprice ;
            }
        }
        else{
            if($request->minprice != 0 || $request->maxprice != 0){
                $e =  ' price BETWEEN ' . $request->minprice . ' and ' . $request->maxprice ;
            }

        }



        $userproducts = DB::select('SELECT  *   FROM  available_properties where ' .$a  .  $b  . $c  . $d . $e );
      
        $allPropertyTypes = PropertyType::all();
        $Journals = Journal::take(3)->get();
        $allHeadings = page::with(['properties' => function($query) {
      $query->distinct('property_type_id');
    }])->get();
    foreach($allHeadings as $head){
      $propertydata = array();
      $data = array();
      $var = 0;
      foreach($head->properties as $head1){
        if(in_array($head1->property_type_id , $data)){
          continue;
        }
        else{
          array_push($propertydata, $head1);
          $var = $head1->property_type_id;
          array_push($data, $var);
        }
      }
      $head->propertydata = $propertydata;
    }
   
        return view('Internation',compact('userproducts','allPropertyTypes','Journals','allHeadings', 't'));
}

// function filterviasize(Request $request){
//    $userproducts = AvailableProperty::where('length', '>=', $request->minsize)->where('length', '<=', $request->maxsize)->with('propertyType')->get();
//     $allPropertyTypes = PropertyType::all();
//     $Journals = Journal::take(3)->get();
//     return view('Buy',compact('userproducts','allPropertyTypes','Journals'));
// }

// function filterviabedrooms(Request $request){
//     $userproducts = AvailableProperty::where('Bedrooms',$request->bedrooms)->with('propertyType')->get();
//     $allPropertyTypes = PropertyType::all();
//     $Journals = Journal::take(3)->get();
//     return view('Buy',compact('userproducts','allPropertyTypes','Journals'));
// }






}
