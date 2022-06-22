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
    <form method="POST" action="{!! url('admin/update-content/'.$GeneralContents->id ) !!}" enctype="multipart/form-data">
       @csrf
    <div class="row">

  <div class="form-group col-6">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control"  name="productname" placeholder="Enter Name" value="{!! $GeneralContents->productname !!}">
  </div>

  

  <div class="form-group col-6">
    <label for="exampleInputPassword1">Description</label>
    <input type="text" class="form-control" name="Description" placeholder="Enter Description"  value="{!! $GeneralContents->Description !!}">
  </div>

    

  

  <div class="form-group col-6">
    <label for="exampleInputPassword1">Property Type</label>
     <select style="height:34px;" class="form-control" name="property_type_id" id="selectCategoryById">
        @foreach($showProperty as $showPropertyIndex)
        <option value="{!!  $showPropertyIndex->id !!}">{!!  $showPropertyIndex->title !!}</option>
        @endforeach
    </select>
  </div>

  





 
  <div class="form-group col-6">
    <label for="exampleInputPassword1">Image</label>
    <input id="imagecontent" style="border:none" type="file" class="form-control p-0 mt-2" name="image"  value="{!! $GeneralContents->picture !!}">
    <p class="mt-3 text-success" id="imageName"></p>
  </div>


  {{-- <div class="form-group col-6">
    <label for="exampleInputEmail1">Latitude</label>
    <input type="text" class="form-control"  name="productname" placeholder="Enter Name" value="{!! $GeneralContents->lat !!}">
  </div>

  <div class="form-group col-6">
    <label for="exampleInputEmail1">Longitude</label>
    <input type="text" class="form-control"  name="productname" placeholder="Enter Name" value="{!! $GeneralContents->lon !!}">
  </div>
  --}}


  </div>
  <button type="submit" class="btn btn-primary mb-5">Submit</button>
</form>
</div>





   
<script>    
  $( document ).ready(function() {
    value = $("#imagecontent").attr('value');
    $("#imageName").html(value);
    console.log(value)
  });

  $("#imagecontent").click(function(){
    $("#imageName").hide();
  });
</script>
























</div>
<!-- LayoutDivs -->
</div>
</div>
</body>
@endsection
