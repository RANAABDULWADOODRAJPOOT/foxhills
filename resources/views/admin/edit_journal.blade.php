@extends('layouts.app')
@section('content')
@if (session('status'))

@endif
@include('admin.adminDashBoardLayout')  
<div class="col-sm-10">
    <h2 class="text-center"class="text-dark">Add Journal</h2>



     <form method="POST"  action="{!! url('admin/update_journal/'.$Journal->id ) !!}"  enctype="multipart/form-data">
       @csrf
        <div class="row my-5">

            <div id="Propertytype" class="form-group col-6">
              <label for="exampleInputPassword1">Property Type</label>
               <select style="height:34px;" class="form-control" name="journal_type" id="selectCategoryById" value="{!! $Journal->journal_type !!}">
                  @foreach($category as $cat)
                  <option value="{!!  $cat->id !!}">{!!  $cat->name !!}</option>
                  @endforeach
              </select>
            </div>
             <div class="form-group col-6">
                <label for="exampleInputEmail1">Journal Title</label>
                <input type="text" class="form-control"  name="journal_title" value="{!! $Journal->journal_title !!}">
            </div>
             
            <div class="form-group col-6">
                <label for="exampleInputPassword1">Profile Image</label>
                <input id="imagecontent" style="border:none" type="file" class="form-control p-0 mt-2" name="image" value="{!! $Journal->picture !!}">
                 <p class="mt-3 text-success" id="imageName"></p>
            </div>
             <div class="form-group col-6">
                <label for="exampleInputEmail1">Publish Date</label>
                <input type="date" class="form-control"  name="Publish_date" value="{!! $Journal->Publish_date !!}">
            </div>
             <div class="form-group col-12">
                <label for="exampleInputEmail1">Description</label>
                <textarea type="text" class="form-control"  name="description"> {!! $Journal->description !!} </textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>








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
