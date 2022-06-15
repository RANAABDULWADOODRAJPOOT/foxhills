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
class internationController extends Controller
{
    function index(){
              $internationProducts = AvailableProperty::where('city', 'not like', '%' . 'dubai' . '%')->with('propertyType')->paginate(30);
              return view('Internation',compact('internationProducts'));
       }
        function detail($id){
        $userProducts = AvailableProperty::where('id',$id)->with('propertyType')->first();
          $Journals = Journal::take(3)->get();
        return view('product_detail',compact('userProducts',' Journals'));
    }

}
