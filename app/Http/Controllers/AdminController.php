<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;

use App;
use Auth;
use DB;
use Session;
// use Reviews;
// use Response;

use App\Models\PropertyType; 
use App\Models\AvailableProperty; 
use App\Models\Journal; 
use App\Models\UserRequest; 
use App\Models\JournalCategory; 
use App\Models\page; 
use App\Models\agent; 
use App\Models\GeneralContent; 
use App\Models\multipicture; 
use App\Models\multipleimageblog; 
use Illuminate\Support\Facades\Validator;





class AdminController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.adminDashBoard');
    }

    public function addPropertyType()
    {
        return view('admin.propertyType');
    }

     public function savePropertyType(Request $request)
     {
        $PropertyType  = new PropertyType;
        $PropertyType->title = $request->propertytype;
        $PropertyType->save();
        return redirect('admin/add-property-type')->with('status', 'Property Type Is Added');
    }

    public function showPropertyType()
     { 
        $showProperty = PropertyType::all();
        return view('admin.show_property_type', compact('showProperty'));
        
    }


   
    


    public function downloadRequests()
    { 
        // $datas = UserRequest::all();


        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
        ,   'Content-type'        => 'text/csv'
        ,   'Content-Disposition' => 'attachment; filename=Requests.csv'
        ,   'Expires'             => '0'
        ,   'Pragma'              => 'public'
    ];

    $list =  UserRequest::all()->toArray();

    # add headers for each column in the CSV download
    array_unshift($list, array_keys($list[0]));

   $callback = function() use ($list) 
    {
        $FH = fopen('php://output', 'w');
        foreach ($list as $row) { 
            fputcsv($FH, $row);
        }
        fclose($FH);
    };

    return response()->stream($callback, 200, $headers);
    
      




}





    public function editPropertyType($id)
     {
       
       $PropertyType = PropertyType::find($id);
       return view('admin.edit_property_type', compact('PropertyType'));
        
    }

    public function showRequest()
    {

        $UserRequests = UserRequest::all();
        return view('admin.User_Request', compact('UserRequests'));

    }

    public function updatePropertyType(Request $request , $id)
     {

       
         $PropertyTypedata = PropertyType::find($id);
         $PropertyTypedata->title = $request->propertytype;
         $PropertyTypedata->save();
         return redirect('admin/show-property-type');
    }

     public function deletePropertyType($id)
     {  

        $hasvalue =  AvailableProperty::where('property_type_id',$id)->get();;
       
        if(!$hasvalue->isEmpty()){
        return redirect()->back()->with("message", "Cant't delete this property type because it is Assoicated with property item please edit the property item to delete this property type");
        }
        else{
         PropertyType::where('id',$id)->delete();
         return redirect('admin/show-property-type');
     }
     }

     public function addItems()
     { 
         $showProperty = PropertyType::all();
         $allagents = agent::all();
        $pagedatas =  page::all();
        return view('admin.upload_items',compact('showProperty','pagedatas','allagents'));
     }
     
      public function saveItems(Request $request)
     {  
        // $validator = Validator::make($request::all(), [
        //     'productname'  => 'required|max:100',
        // ]);


        // if($validator->fails()) {
        //     return Redirect::back()->withErrors($validator);
        // }
          
        
        
        $request->validate([
          'image' => 'mimes:jpeg,jpg,png,gif|required'
        ]);

        


        $GeneralContent = new AvailableProperty(); 

        if($request->file('image')){
            $file = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $newImageName = time() . '-' .  $filename  . '.' . $extension;
            $request->image->move(public_path('assets/allimages'),$newImageName);
            $request->request->add(['picture' => $newImageName]);
            $GeneralContent->picture = $request->picture;
        }
        if($request->file('bannerimage')){
            $file = $request->file('bannerimage')->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $token = rand(0,10000000000000);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $newImageName = $token . '-' .  $filename  . '.' . $extension;
            $request->bannerimage->move(public_path('assets/allimages'),$newImageName);
            $GeneralContent->bannerimage = $newImageName;
        }
        
        if($request->status == 1){
           $data = AvailableProperty::create($request->except(['_token','image']));
           AvailableProperty::where('id',  $data->id)->update(array('bannerimage' => $newImageName));
        }
        else {
            
             $GeneralContent->productname = $request->productname ? $request->productname : 0;
             $GeneralContent->city = $request->city ? $request->city : 0;
             $GeneralContent->Description = $request->Description ? $request->Description : 0;
             $GeneralContent->Price = $request->Price ? $request->Price : 0;
             $GeneralContent->Area = $request->Area ? $request->Area : 0;
             $GeneralContent->Bedrooms = $request->Bedrooms ? $request->Bedrooms  : 0;
             $GeneralContent->bathrooms = $request->bathrooms ? $request->bathrooms  : 0;
             $GeneralContent->featured = $request->featured ? $request->featured  : 0;
             $GeneralContent->property_type_id = $request->property_type_id;
             $GeneralContent->Category = $request->Category ? $request->Category  : 0;
             $GeneralContent->length = $request->length ? $request->length  : 0;
             $GeneralContent->Speciality = $request->Speciality ? $request->Speciality  : 0;
             $GeneralContent->status = $request->status ? $request->status : 0;
             $GeneralContent->Completion = $request->Completion ? $request->Completion : 0;
             
            $GeneralContent->save();
             }


        return redirect()->back()->with('message', 'Record Added Sucessfully');
        // dd("inserted",AvailableProperty::where('id',1)->with('propertyType')->first());
     }


     public function showItems()
     { 
        $AvailableProperties = AvailableProperty::with('propertyType')->get();
       
        return view('admin.show_property_items',compact('AvailableProperties'));
     }

       public function editItems($id)
     { 
         $AvailableProperty = AvailableProperty::find($id);
         $showProperty = PropertyType::all();
         $allagents =  agent::all();
         return view('admin.edit_available-property', compact('AvailableProperty','showProperty','allagents'));
     }

       public function updateItems(Request $request , $id)
     { 

       $AvailableProperty = AvailableProperty::find($id);
       $request->validate([
          'image' => 'mimes:jpeg,jpg,png,gif'
        ]);
       if($request->file('image')){
        $file = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $newImageName = time() . '-' .  $filename  . '.' . $extension;
        $request->image->move(public_path('assets/allimages'),$newImageName);
        $request->request->add(['picture' => $newImageName]);
        $AvailableProperty->picture = $request->picture;
    }
    if($request->file('bannerimage')){
        $file = $request->file('bannerimage')->getClientOriginalName();
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $token = rand(0,10000000000000);
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $newImageName = $token . '-' .  $filename  . '.' . $extension;
        $request->bannerimage->move(public_path('assets/allimages'),$newImageName);
         $AvailableProperty->bannerimage = $newImageName;
    }
    
        
        $AvailableProperty->productname = $request->productname;
        $AvailableProperty->city = $request->city;
        $AvailableProperty->Description = $request->Description;
        $AvailableProperty->Price = $request->Price;
        $AvailableProperty->Area = $request->Area;
        $AvailableProperty->Bedrooms = $request->Bedrooms;
        $AvailableProperty->bathrooms = $request->bathrooms;
        $AvailableProperty->featured = $request->featured ? $request->featured  : 0;
        $AvailableProperty->property_type_id = $request->property_type_id;
        $AvailableProperty->Category = $request->selectCategory;
        $AvailableProperty->length = $request->length;
        $AvailableProperty->Speciality = $request->Speciality;
        $AvailableProperty->Completion = $request->Completion;
        $AvailableProperty->agent = $request->agent;
        $AvailableProperty->lat = $request->lat;
        $AvailableProperty->lon = $request->lon;
        $AvailableProperty->save();
        return redirect('admin/show-upload-items');
     }

     public function deleteItems($id)
     { 
         AvailableProperty::where('id',$id)->delete();
         return redirect('admin/show-upload-items');
     }

     public function uploadJournals()
     {     
          
            $alldata= Journal::all();
            $category = JournalCategory::all();
           return view('admin.upload_journals',compact('alldata','category'));  
     }

     public function multiJournals()
     {    
           return view('admin.uploadblogmultiple');  
     }

       public function saveJournalspics(Request $request)
     { 
         $arrLength = count($request->data);
        for($i=0;$i<$arrLength;$i++){
                $file = $request->data[$i]->getClientOriginalName();
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $token = rand(0,10000000000000);
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                $newImageName = $token . '-' .  $filename  . '.' . $extension;
                $request->data[$i]->move(public_path('assets/allimages'),$newImageName);
                multipleimageblog::create([
                    'picture' => $newImageName,
                ]);
               $token = 0;
            }

             return redirect()->back()->with("message", "record Added");

       //  $alldata = multipleimageblog::all();
       // return view('Admin.upload_journals',compact('alldata')); 
     }

      public function saveJournals(Request $request)
     { 
         

        $file = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $newImageName = time() . '-' .  $filename  . '.' . $extension;
        $request->image->move(public_path('assets/allimages'),$newImageName);
        $request->request->add(['picture' => $newImageName]);
        $data = Journal::create($request->except(['_token','image']));
        return redirect()->back()->with("message", "record Added");
        // dd("inserted",AvailableProperty::where('id',1)->with('propertyType')->first());
     }

     public function showJournals()
     { 
        $Journals = Journal::all();

        return view('admin.show_journal',compact('Journals'));  
    }

    public function editJournals($id)
    { 
         $Journal = Journal::find($id);
         $category = JournalCategory::all();
        return view('admin.edit_journal',compact('Journal', 'category'));  
    }


    public function updateJournals(Request $request , $id)
    { 
        $Journal = Journal::find($id);
        $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif'
        ]);
        if($request->file('image')){
            $file = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $newImageName = time() . '-' .  $filename  . '.' . $extension;
            $request->image->move(public_path('assets/allimages'),$newImageName);
            $request->request->add(['picture' => $newImageName]);
            $Journal->picture = $request->picture;
        }
        $Journal->journal_type = $request->journal_type;
        $Journal->journal_title = $request->journal_title;
        $Journal->Publish_date = $request->Publish_date;
        $Journal->description = $request->description;
        $Journal->save();
        return redirect('admin/show-journals'); 
    }






    public function deleteJournals($id)
     { 
         Journal::where('id',$id)->delete();
         return redirect('admin/show-journals');
     }


     public function createPage()
     { 
           return view('admin.dynamicheader');
     }
     

     public function savepage(Request $request)
     { 
        $page  = new page;
        $page->heading = $request->headings;
        $page->location = $request->location;
        $page->save();
        return redirect()->back()->with("message", "heading Added");
     }

      public function showpage()
     { 
       $pagedatas =  page::all();
       return view('admin.show_headings',compact('pagedatas'));

     }

      public function editpage($id)
    { 
        $page = page::find($id);
        return view('admin.edit_heading',compact('page'));  
    }


    public function updatepage(Request $request , $id)
    { 
        $page = page::find($id);
        $page->heading = $request->headings;
         $page->location = $request->location;
        $page->save();
        return redirect('admin/show-pages');
    }


     public function deletepage($id)
     { 
         page::where('id',$id)->delete();
         return redirect('admin/show-pages');
     }

      public function showgeneral()
     { 
         $GeneralContents = GeneralContent::with('propertyType')->get();

        return view('admin.show_general_content',compact('GeneralContents')); 
     }

      public function editcontent($id)
    { 
        $GeneralContents = GeneralContent::find($id);
        $showProperty = PropertyType::all();
        return view('admin.edit_content',compact('GeneralContents','showProperty'));  
    }


    public function updatecontent(Request $request , $id)
    { 

       $GeneralContent = GeneralContent::find($id);

       $request->validate([
          'image' => 'mimes:jpeg,jpg,png,gif'
        ]);
       if($request->file('image')){
        $file = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $newImageName = time() . '-' .  $filename  . '.' . $extension;
      
            $request->image->move(public_path('assets/allimages'),$newImageName);
        
        $request->request->add(['picture' => $newImageName]);
        $GeneralContent->picture = $request->picture;
    }

        
        $GeneralContent->productname = $request->productname;
        $GeneralContent->Description = $request->Description;
        $GeneralContent->property_type_id = $request->property_type_id;
        $GeneralContent->save();
        return redirect('admin/show-general-page');
    }


     public function deletecontent($id)
     { 
        
         GeneralContent::where('id',$id)->delete();
         return redirect('admin/show-general-page');
     }


      public function addagent()
     { 
           return view('admin.addagent');  
     }

      public function saveagent(Request $request)
     { 
       
        $file = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $newImageName = time() . '-' .  $filename  . '.' . $extension;
        $request->image->move(public_path('assets/allimages'),$newImageName);
        $request->request->add(['picture' => $newImageName]);
        $data = agent::create($request->except(['_token','image']));
        agent::where('id',  $data->id)->update(array(
            'description' => $request->description,
            'experience' => $request->experience,
            'Language' => $request->Language,
        ));
        return redirect()->back()->with('message', 'Record Added Sucessfully');
     }

     public function showagent()
     { 
        $showagent = agent::all();

        return view('admin.showagent',compact('showagent'));  
    }

    public function editaddagent($id)
    { 
        $editaddagent = agent::find($id);
        return view('admin.editagent',compact('editaddagent'));  
    }


      public function updateagent(Request $request , $id)
    { 
        $agent = agent::find($id);
        $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif'
        ]);
        if($request->file('image')){
            $file = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $newImageName = time() . '-' .  $filename  . '.' . $extension;
            $request->image->move(public_path('assets/allimages'),$newImageName);
            $request->request->add(['picture' => $newImageName]);
            $agent->picture = $request->picture;
        }
        $agent->agentname = $request->agentname;
        $agent->Licence = $request->Licence;
        $agent->Desigination = $request->Desigination;
        $agent->description = $request->description;
        $agent->experience = $request->experience;
        $agent->Language = $request->Language;
       
        $agent->save();
        return redirect('admin/showagent'); 
    }


     public function deleteagent($id)
     { 
         agent::where('id',$id)->delete();
            return redirect('admin/showagent'); 
     }


     public function multiplePictures($id)
     {  
        $propertydata = AvailableProperty::find($id);
        return view('admin/uploadmutipleimages',compact('propertydata')); 
     }

      public function multipic(Request $request)
     {  
        $arrLength = count($request->data);
        for($i=0;$i<$arrLength;$i++){
                $id= $request->id;
                $file = $request->data[$i]->getClientOriginalName();
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $token = rand(0,10000000000000);
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                $newImageName = $token . '-' .  $filename  . '.' . $extension;
                $request->data[$i]->move(public_path('assets/allimages'),$newImageName);
                multipicture::create([
                    'product_id' => $id,
                    'picture' => $newImageName,
                ]);
               $token = 0;
            }

           return redirect()->back()->with('message', 'Record Added Sucessfully');
     }


   
   


    

     

}
