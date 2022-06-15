<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PropertyType; 
use App\Models\AvailableProperty; 
use App\Models\Journal;

class projectController extends Controller
{
     function index(){
          $projectProducts = AvailableProperty::where('Category',3)->with('propertyType')->get();
          return view('Project',compact('projectProducts'));
     }
      function detail($id){
        $userProducts = AvailableProperty::where('id',$id)->with('propertyType')->first();
          $Journals = Journal::take(3)->get();
        return view('product_detail',compact('userProducts','Journals'));
    }



}
