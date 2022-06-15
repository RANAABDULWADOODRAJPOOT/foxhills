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

class rentController extends Controller
{
    function index(){
        $rentproducts = AvailableProperty::where('Category',2)->with('propertyType')->paginate(30);
        $allPropertyTypes = PropertyType::all();
        $Journals = Journal::take(3)->get();
        return view('Rent',compact('rentproducts','allPropertyTypes','Journals'));
    }
    function detail($id){
        $userProducts = AvailableProperty::where('id',$id)->with('propertyType')->first();
          $Journals = Journal::take(3)->get();
        return view('product_detail',compact('userProducts','Journals'));
    }

}
