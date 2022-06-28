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
              $MostviewJournals = Journal::paginate(6);
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
   
              return view('journal',compact('Journals','allHeadings','MostviewJournals','AllJournals'));
       }
       
       
       function filterbycategory($id){

        if($id==0){
          $AllJournals = Journal::paginate(6);
          $MostviewJournals=Journal::paginate(6)->reverse()->values();
        
         
        }else{
          $AllJournals = Journal::where('journal_type',$id)->paginate(6);
          $MostviewJournals=Journal::where('journal_type',$id)->paginate(6)->reverse()->values();

        //   $AllJournals = Journal::macro('sortDesc', function () {
        //     return $this->sort(function($a, $b)  {
        //         if ($a == $b) {
        //             return 0;
        //         }
        //         return ($a > $b) ? -1 : 1;
        //     });
        // });
         
        }
        
            
    $category = JournalCategory::all();

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
    
   
            return view('journal',compact('category','AllJournals','allHeadings','MostviewJournals'));
            
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
   
              return view('journal_detail',compact('Journals','allHeadings'));
       }

}
