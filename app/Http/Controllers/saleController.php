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
use App\Models\UserRequest; 
use App\Models\page; 

class saleController extends Controller
{
    function index(){
        
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
   
        $Journals = Journal::take(3)->get();
        return view('Sale',compact('Journals','allHeadings'));
    }

   function saveRequest(Request $request){
       UserRequest::create($request->except(['_token']));
        return redirect()->back();


}

}
