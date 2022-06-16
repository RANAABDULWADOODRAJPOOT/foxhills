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

class locationController extends Controller
{
   function index(){
              $locationproducts = AvailableProperty::where('city', 'like', '%' . 'dubai' . '%')->where('Category',1)->with('propertyType')->paginate(9);
              return view('Location',compact('locationproducts'));
       }

       function detail($id){
        $userProducts = AvailableProperty::where('id',$id)->with('propertyType')->first();
          $Journals = Journal::take(3)->get();
        return view('product_detail',compact('userProducts','Journals'));
    }


}
