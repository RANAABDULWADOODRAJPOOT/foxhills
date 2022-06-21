@extends('layouts.app')
@section('content')
@if (session('status'))

@endif
@include('admin.adminDashBoardLayout')  
<div class="col-sm-10">
    <h2 class="text-center"class="text-dark">EDIT</h2>



    <form method="POST" action="{!! url('admin/updateagent/'.$editaddagent->id ) !!}"  enctype="multipart/form-data">
       @csrf
    <div class="row my-5">
            <div class="form-group col-6">
                <label for="exampleInputEmail1">Agnet name</label>
                <input type="text" class="form-control"  name="agentname" value="{!! $editaddagent->agentname !!}">
            </div>
             <div class="form-group col-6">
                <label for="exampleInputEmail1">Licence Number</label>
                <input type="text" class="form-control"  name="Licence" value="{!! $editaddagent->Licence !!}">
            </div>
             
            <div class="form-group col-6">
                <label for="exampleInputPassword1">Profile Image</label>
                <input id="imagecontent" style="border:none" type="file" class="form-control p-0 mt-2" name="image" value="{!! $editaddagent->picture !!}">
                 <p class="mt-3 text-success" id="imageName"></p>
            </div>
             <div class="form-group col-6">
                <label for="exampleInputEmail1">Desigination</label>
                <input type="text" class="form-control"  name="Desigination" value="{!! $editaddagent->Desigination !!}">
            </div>

             <div class="form-group col-6">
                <label for="exampleInputEmail1">Description</label>
                <input type="text" class="form-control"  name="description" value="{!! $editaddagent->description !!}">
            </div>
            
             <div class="form-group col-6">
                <label for="exampleInputEmail1">Experience</label>
                <input type="text" class="form-control"  name="experience" value="{!! $editaddagent->experience !!}">
            </div>
            

             <div class="form-group col-6">
                <label for="exampleInputEmail1">Language</label>
                <input type="text" class="form-control"  name="Language" value="{!! $editaddagent->Language !!}">
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
