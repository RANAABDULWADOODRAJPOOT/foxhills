<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyType; 
use App\Models\AvailableProperty; 
use App\Models\Journal; 
use App\Models\page; 
use App\Models\GeneralContent; 
use App\Models\multipicture; 
use App\Models\agent;
class luxhabitateIndexController extends Controller
{
    

function index()
{  
   
    $typeone = '';
    $typetwo = '';
    $typethree = '';
 

    $allHeadings = page::with(['properties' => function($query) {
      $query->distinct('property_type_id');
    }])->get();
    foreach($allHeadings as $head){
      $propertydata = array();
      $data = array();
      $var = 0;
      $pro= collect($head->properties)->sortByDesc('id');
      foreach($pro as $head1){
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
   

  

$fistRow = PropertyType::first('id');
    if(!empty($fistRow)){
    $typeone_new = AvailableProperty::where('property_type_id',$fistRow->id)->orderBy('created_at', 'DESC')->take(3)->get();
    $typeone_price = AvailableProperty::where('property_type_id',$fistRow->id)->orderBy('Price', 'DESC')->take(3)->get();
    $typeone_feature = AvailableProperty::where('property_type_id',$fistRow->id)->where('featured', 1)->take(3)->get();
    }
    
    $secondRow = PropertyType::skip(1)->first();
    if(!empty($secondRow)){
    // $typetwo = AvailableProperty::where('property_type_id',$secondRow->id)->with('propertyType')->orderBy('property_type_id', 'ASC')->take(9)->get();
    $typetwo_new = AvailableProperty::where('property_type_id',$secondRow->id)->orderBy('created_at', 'DESC')->take(3)->get();
    $typetwo_price = AvailableProperty::where('property_type_id',$secondRow->id)->orderBy('Price', 'DESC')->take(3)->get();
    $typetwo_feature = AvailableProperty::where('property_type_id',$secondRow->id)->where('featured', 1)->take(3)->get();

    }
    
    $thirdRow = PropertyType::skip(2)->first();
     if(!empty($thirdRow)){
    $typethree = AvailableProperty::where('property_type_id',$thirdRow->id)->with('propertyType')->orderBy('property_type_id', 'ASC')->take(3)->get();
    }

    $AvailableProperty = AvailableProperty::where('featured',true)->get()->random();
    // if(!empty($AvailableProperty)){
    //   foreach($AvailableProperty as $j){
    //     $x[] = $j->id; 
    //   }
    //   $random_key=array_rand($x);
    //   if($random_key == 0){
    //     $random_key=$random_key+1; 
    //   }

    //   $AvailableProperty = AvailableProperty::where('id',$random_key);


      // $AvailablePropertys = AvailableProperty::where('id',$random_key);
      // $AvailableProperty = collect($AvailablePropertys)->last();
    // }
     
     
    

  $Journals = Journal::take(3)->get();
  return view('homepage',compact('typeone_new','typeone_price','typeone_feature','typetwo_new','typetwo_price','typetwo_feature','typethree','Journals','allHeadings','AvailableProperty'));
}

function pagedata($name,$id,$type='')
{  

  if ($type == 1 ) {
    $alldatas = page::where('id',$name)->with(['properties'=> function($q) use ($id) {
      $q->where('property_type_id',$id);
    }])->get();
    
    $allHeadings = page::with(['properties' => function($query) {
      $query->distinct('property_type_id');
    }])->get();
    foreach($allHeadings as $head){
      $propertydata = array();
      $data = array();
      $var = 0;
      $pro= collect($head->properties)->sortByDesc('id');
      foreach($pro as $head1){
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
    return view('Buy',compact('alldatas','Journals','allHeadings'));
  }
  else{
    $status =  GeneralContent::where('Category',$id)->first();
    if(is_null($status)){
      $alldatas = page::where('id',$id)->with(['properties'])->get();
       
      foreach($alldatas as $data){
        if ( $data->properties->isEmpty() ) {
          
    $allHeadings = page::with(['properties' => function($query) {
      $query->distinct('property_type_id');
    }])->get();
    foreach($allHeadings as $head){
      $propertydata = array();
      $data = array();
      $var = 0;
      $pro= collect($head->properties)->sortByDesc('id');
      foreach($pro as $head1){
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
          return view('content_not_found',compact('Journals','allHeadings'));
        }
      } 

      
    $allHeadings = page::with(['properties' => function($query) {
      $query->distinct('property_type_id');
    }])->get();
    foreach($allHeadings as $head){
      $propertydata = array();
      $data = array();
      $var = 0;
      $pro= collect($head->properties)->sortByDesc('id');
      foreach($pro as $head1){
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
      return view('Buy',compact('alldatas','Journals','allHeadings'));
    }
    else{
      $GeneralContents = GeneralContent::where('Category',$id)->first();
      
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
      return view('generalcontent',compact('GeneralContents','Journals','allHeadings'));
    }
  }

    }

function datadetail($id)
{  

   $userProducts = AvailableProperty::find($id);
   $userProductsid = $userProducts->id;
   $alluserProducts = AvailableProperty::where('id','!=',$userProductsid)->get()->take(3);
   
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
   $images = multipicture::select('picture')->where('product_id',$id)->get();
   return view('product_detail',compact('userProducts','Journals','allHeadings','alluserProducts','images'));
}

function agents(){

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
 $allagents = agent::all();
  return view('agentgrid',compact('allHeadings','allagents'));
}

function agent(){
  $allagents = agent::all();
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

  return view('agent', compact('allHeadings','allagents'));
}


function agentdetails($id){

  $agentdetails = agent::find($id);
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
 
  return view('agent', compact('allHeadings','agentdetails'));
}




}
