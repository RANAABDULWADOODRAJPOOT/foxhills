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
    
<h2 class="text-center"class="text-dark">Edit Page</h2>

    
  

  <div  class="mt-5">
    <h3 style="font-weight:500" class="mb-4">Add Details</h3>
    <form method="POST" action="{!! url('admin/update-upload-items/'.$AvailableProperty->id ) !!}" enctype="multipart/form-data">
       @csrf
    <div class="row">

  <div class="form-group col-6">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control"  name="productname" placeholder="Enter Name" value="{!! $AvailableProperty->productname !!}">
  </div>

  <div class="form-group col-6">
    <label for="exampleInputPassword1">City</label>
    <input type="text" class="form-control" name="city" placeholder="Enter city" value="{!! $AvailableProperty->city !!}">
  </div>

  <div class="form-group col-6">
    <label for="exampleInputPassword1">Description</label>
    <input type="text" class="form-control" name="Description" placeholder="Enter Description"  value="{!! $AvailableProperty->Description !!}">
  </div>

    <div class="form-group col-6">
    <label for="exampleInputEmail1">Price</label>
    <input type="text" class="form-control" name="Price"  placeholder="Enter Price"  value="{!! $AvailableProperty->Price !!}">
  </div>

  <div class="form-group col-6">
    <label for="exampleInputEmail1">Area</label>
    <input type="text" class="form-control" name="Area"  placeholder="Enter Price"  value="{!! $AvailableProperty->Area !!}">
  </div>

  <div class="form-group col-6">
    <label for="exampleInputEmail1">Bedrooms</label>
    <input type="text" class="form-control" name="Bedrooms"   value="{!! $AvailableProperty->Bedrooms !!}">
  </div>

  <div class="form-group col-6">
    <label for="exampleInputEmail1">Bathrooms</label>
    <input type="text" class="form-control" name="bathrooms"   value="{!! $AvailableProperty->bathrooms !!}">
  </div>

  <div class="form-group col-6">
    <label for="exampleInputEmail1">length</label>
    <input type="text" class="form-control" name="length"  placeholder="Enter Price"  value="{!! $AvailableProperty->length !!}">
  </div>

  <div class="form-group col-6">
    <label for="exampleInputEmail1">Speciality</label>
    <input type="text" class="form-control" name="Speciality"  placeholder="Enter Price"  value="{!! $AvailableProperty->Speciality !!}">
  </div>

  <div class="form-group col-6">
    <label for="exampleInputEmail1">Category</label>
    <select class="selectCategory form-control" style="height:34px;"  name="selectCategory" id="selectCategoryById">
      <option  style="display: none" value="{!! $AvailableProperty->Category !!}">{!! App\Models\AvailableProperty::getPropertyType($AvailableProperty->Category) !!}</option>
      <option value="1">Sale Product</option>
      <option value="2">Rental Product</option>
    </select>
  </div>

  <div class="form-group col-6">
    <label for="exampleInputPassword1">Property Type</label>
     <select style="height:34px;" class="form-control" name="property_type_id" id="selectCategoryById">
        @foreach($showProperty as $showPropertyIndex)
        <option value="{!!  $showPropertyIndex->id !!}">{!!  $showPropertyIndex->title !!}</option>
        @endforeach
    </select>
  </div>

  <div id="Completion" class="form-group col-6">
    <label for="exampleInputPassword1">Completion:</label>
    <input  type="text" class="form-control  mt-2" name="Completion" value="{!! $AvailableProperty->Completion !!}">
  </div>


  <div id="agenttype" class="form-group col-6">
    <label for="exampleInputPassword1">Select the agent</label>
    <select style="height:34px;" class="form-control" name="agent" id="selectCategoryById">
      @foreach($allagents as $agents)
      <option value="{!!  $agents->id !!}">{!!  $agents->agentname !!}</option>
      @endforeach
    </select>
  </div>





 


  <div class="form-group col-6">
    <label for="exampleInputEmail1">Latitude</label>
    <input type="text" class="form-control"  name="lat"  value="{!! $AvailableProperty->lat !!}">
  </div>

  <div class="form-group col-6">
    <label for="exampleInputEmail1">Longitude</label>
    <input type="text" class="form-control"  name="lon" value="{!! $AvailableProperty->lon !!}">
  </div>


  <div class="form-group col-6">
    <label for="exampleInputPassword1">Feature</label>
    <select style="height:34px;" class="form-control" name="featured" value="{!! $AvailableProperty->featured !!}">
     
      <option value="0" >No</option>
      <option value="1" >Yes</option>
    
    </select>
  </div>
 
  <div class="form-group col-6">
    <label for="exampleInputPassword1">Image</label>
    <input id="imagecontent" style="border:none" type="file" class="form-control p-0 mt-2" name="image"  value="{!! $AvailableProperty->picture !!}">
    <p class="mt-3 text-success" id="imageName"></p>
  </div>

  <div class="form-group col-6">
    <label for="exampleInputPassword1">banner Image</label>
    <input id="bannerimage" style="border:none" type="file" class="form-control p-0 mt-2" name="bannerimage"  value="{!! $AvailableProperty->bannerimage !!}">
    <p class="mt-3 text-success" id="bannerimageName"></p>
  </div>

 


  </div>
  <button type="submit" class="btn btn-primary mb-5">Submit</button>
</form>
</div>





   
<script>    
  $( document ).ready(function() {
    value = $("#imagecontent").attr('value');
    $("#imageName").html(value);

     values = $("#bannerimage").attr('value');
    $("#bannerimageName").html(values);

  });

  $("#imagecontent").click(function(){
    $("#imageName").hide();
  });

  $("#bannerimage").click(function(){
    $("#bannerimageName").hide();
  });


</script>
























</div>
<!-- LayoutDivs -->
</div>
</div>
</body>
@endsection
