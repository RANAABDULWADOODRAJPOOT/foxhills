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
use App\Models\JournalCategory; 
use App\Models\page; 

class journalController extends Controller
{
       function index(){
              $MostviewJournals = '';
              $AllJournals = Journal::paginate(9);
              $Journals = Journal::paginate(9);
              $Journalp = Journal::get('id'); 
              if(!empty($Journalp)){
              foreach($Journalp as $j){
              $x[] = $j->id; 
              }
              $size = sizeof($x);

              $random_key=rand(1,$size);
              if($random_key == 0){
                $random_key=$random_key+1; 
              }
              $MostviewJournals = Journal::where('id',$random_key)->paginate(9);
            }
              
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
   
              return view('journal',compact('Journals','allHeadings','MostviewJournals','AllJournals'));
       }
       
       
       function filterbycategory($id){

        if($id==0){
          $AllJournals = Journal::paginate(6);
        
         
        }else{
          $AllJournals = Journal::where('journal_type',$id)->paginate(6);
         
        }
        
            
    $category = JournalCategory::all();

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
   
            return view('journal',compact('category','AllJournals','allHeadings'));
            
       }
       
       
       
       
       
       function detail($id){
            
              $Journals = Journal::find($id);
             
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
   
              return view('journal_detail',compact('Journals','allHeadings'));
       }

}
