@extends('layouts.app')
@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
@include('admin.adminDashBoardLayout')  
<div class="col-sm-10">


@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

@if($errors->any())
  {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
@endif



@if(count($showProperty) === 0)
<h2 class="text-center font-weight-bold text-danger"class="text-dark">Please Add The Property Type First</h2>
<div class="col-12 text-center">
<a href="{!! url('admin/add-property-type') !!}">
    <button class="btn btn-primary text-center my-5 btn-md">Add property Type</button>
</a>
</div>
@else  

  

<h2 class="text-center"class="text-dark">Please Select The Category</h2>

    <select style="height:40px;" class="form-control my-5" name="selectCategory" id="selectCategoryById" required>
      <label for="exampleInputEmail1">Category <span style="color: red">*</span></label>
        <option style="display:none" value="0">Categories</option>
        @foreach($pagedatas as $pagedata)
        <option value="{!! $pagedata->id !!}">{!! $pagedata->heading !!}</option>
        @endforeach
    </select>

{{-- 
    <select style="height:40px;" class="form-control my-5 d-none" name="selection" id="selection">
      <label for="exampleInputEmail1">Property Type</label>
        <option style="display:none" value="0">Categories</option>
        @foreach($showProperty as $propertydata)
        <option value="{!! $propertydata->id !!}" selected>{!! $propertydata->title !!}</option>
        @endforeach
        <option value="2">General Content</option>

    </select> --}}


  

  <div class="mt-5 ">
    <h3 style="font-weight:500" class="mb-4">Add Details</h3>
    <form method="POST" action="{{url('admin/save-items')}}" enctype="multipart/form-data">
       @csrf
    <div class="row">

  <div class="form-group col-6">
    <label for="exampleInputEmail1">Name <span style="color: red">*</span></label>
    <input type="text" class="form-control"  name="productname" placeholder="Enter Name" required>
  </div>

  <div id="City" class="form-group col-6">
    <label for="exampleInputPassword1">City <span style="color: red">*</span></label>
    <input type="text" class="form-control" name="city" placeholder="e.g Dubai" required>
  </div>

  <div  class="form-group col-12">
    <label for="exampleInputPassword1">Description</label>
    <textarea type="text" class="form-control" name="Description"></textarea>
  </div>

    <div id="Price" class="form-group col-6">
    <label for="exampleInputEmail1">Price <span style="color: red">*</span></label>
    <input type="text" class="form-control" name="Price"  placeholder="200000000" required>
  </div>

  <div id="Area" class="form-group col-6">
    <label for="exampleInputEmail1">Location <span style="color: red">*</span></label>
    <input type="text" class="form-control" name="Area"  placeholder="e.g Dubai West" required>
  </div>

  <div id="Bedrooms" class="form-group col-6">
    <label for="exampleInputEmail1">Bedrooms</label>
    <input type="text" class="form-control" name="Bedrooms"  placeholder="e.g. 5" >
  </div>

  <div id="Bedrooms" class="form-group col-6">
    <label for="exampleInputEmail1">Bathrooms</label>
    <input type="text" class="form-control" name="bathrooms"  placeholder="e.g. 5" >
  </div>

  <div id="length" class="form-group col-6">
    <label for="exampleInputEmail1">Area <span style="color: red">*</span></label>
    <input type="text" class="form-control" name="length"  placeholder="2200" required>
  </div>

  <div id="Speciality" class="form-group col-6">
    <label for="exampleInputEmail1">Speciality</label>
    <input type="text" class="form-control" name="Speciality"   >
  </div>

  <div id="Propertytype" class="form-group col-6">
    <label for="exampleInputPassword1">Property Type</label>
     <select style="height:34px;" class="form-control" name="property_type_id" id="selectCategoryById">
        @foreach($showProperty as $showPropertyIndex)
        <option value="{!!  $showPropertyIndex->id !!}">{!!  $showPropertyIndex->title !!}</option>
        @endforeach
    </select>
  </div>



    <div id="Completion" class="form-group col-6">
    <label for="exampleInputPassword1">Completion:</label>
    <input  type="text" class="form-control  mt-2" name="Completion" value="0">
  </div>

  <div class="form-group col-6 ">
    <input id="setCategory" type="hidden" name="Category">
  </div>

  <div id="agenttype" class="form-group col-6">
    <label for="exampleInputPassword1">Select the agent</label>
    <select style="height:34px;" class="form-control" name="agent" id="selectCategoryById">
      @foreach($allagents as $agents)
      <option value="{!!  $agents->id !!}">{!!  $agents->agentname !!}</option>
      @endforeach
    </select>
  </div>

  <div id="Completion" class="form-group col-6">
    <label for="exampleInputPassword1">Add Latitude:</label>
    <input  type="text" class="form-control  mt-2" name="lat" value="0">
  </div>


  <div id="Completion" class="form-group col-6">
    <label for="exampleInputPassword1">Add Longitude:</label>
    <input  type="text" class="form-control  mt-2" name="lon" value="0">
  </div>


   <div class="form-group col-6 ">
    <input id="setstatus" type="hidden" name="status">
  </div>

  <div class="form-group col-6">
    <label for="exampleInputPassword1">Feature</label>
    <select style="height:34px;" class="form-control" name="featured">
     
      <option value="0" selected>No</option>
      <option value="1">Yes</option>
    
    </select>
  </div>


  <div class="form-group col-6">
    <label for="exampleInputPassword1">Image <span style="color: red">*</span></label>
    <input style="border:none" type="file" class="form-control p-0 mt-2" name="image" required>
  </div>


  <div id="bannerimage" class="form-group col-6">
    <label for="exampleInputPassword1" class="required">bannerimage <span style="color: red">*</span></label>
    <input style="border:none" type="file" class="form-control p-0 mt-2 required" name="bannerimage" required>
  </div>


  </div>
  <button type="submit" class="btn btn-primary mb-5">Submit</button>
</form>



</div>





   

<script>    
    $( "#selectCategoryById" ).on( "change", function() {
        var a =  $('#selectCategoryById option:selected').val();
        $( "#selection" ).removeClass( "d-none" )
        document.getElementById("setCategory").value = a;
    });

    //  $( "#selection" ).on( "change", function() {
    //     var select =  $('#selection option:selected').val();
    //      document.getElementById("setstatus").value = select;
    //     if(select == 1){
    //        $( "#otherType" ).removeClass( "d-none" );
    //         $( "#City" ).removeClass("d-none");
    //         $( "#Price" ).removeClass("d-none");
    //         $( "#Area" ).removeClass("d-none");
    //         $( "#Bedrooms" ).removeClass("d-none");
    //         $( "#length" ).removeClass("d-none");
    //         $( "#Completion" ).removeClass("d-none");
    //         $( "#bannerimage" ).removeClass("d-none");
    //         $( "#Speciality" ).removeClass("d-none");
    //         $( "#Completion" ).removeClass("d-none");
    //          $( "#bannerimage" ).removeClass("d-none");
    //           $( "#agenttype" ).removeClass("d-none");
    //          $( "#Propertytype" ).removeClass("d-none");
    //       }
    //     else
    //     {
    //        $( "#otherType" ).removeClass( "d-none" );
    //         $( "#City" ).addClass("d-none");
    //         $( "#Price" ).addClass("d-none");
    //         $( "#Area" ).addClass("d-none");
    //         $( "#Bedrooms" ).addClass("d-none");
    //         $( "#length" ).addClass("d-none");
    //         $( "#Completion" ).addClass("d-none");
    //          $( "#bannerimage" ).addClass("d-none");
    //         $( "#Speciality" ).addClass("d-none");
    //         $( "#Completion" ).addClass("d-none");
    //            $( "#bannerimage" ).addClass("d-none");
    //          $( "#agenttype" ).addClass("d-none");
    //         $( "#Propertytype" ).addClass("d-none");
         
    //     }
    // });




    $("#my-select option[name='myName']").prop('selected', true);

</script>
















@endif






</div>
<!-- LayoutDivs -->
</div>
</div>
</body>
@endsection
