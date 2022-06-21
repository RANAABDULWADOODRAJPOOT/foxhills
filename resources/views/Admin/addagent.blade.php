@extends('layouts.app')
@section('content')
@if (session('status'))

@endif
@include('admin.adminDashBoardLayout')  
<div class="col-sm-10">
    <h2 class="text-center"class="text-dark">Add Journal</h2>



     <form method="POST" action="{{url('admin/save-agent')}}"  enctype="multipart/form-data">
       @csrf
        <div class="row my-5">
            <div class="form-group col-6">
                <label for="exampleInputEmail1">Agnet name</label>
                <input type="text" class="form-control"  name="agentname" required>
            </div>
             <div class="form-group col-6">
                <label for="exampleInputEmail1">Licence Number</label>
                <input type="text" class="form-control"  name="Licence" required>
            </div>
             
            <div class="form-group col-6">
                <label for="exampleInputPassword1">Profile Image</label>
                <input style="border:none" type="file" class="form-control p-0 mt-2" name="image" required>
            </div>
             <div class="form-group col-6">
                <label for="exampleInputEmail1">Desigination</label>
                <input type="text" class="form-control"  name="Desigination" required>
            </div>

             <div class="form-group col-6">
                <label for="exampleInputEmail1">description</label>
                <input type="text" class="form-control"  name="description" required>
            </div>

            <div class="form-group col-6">
                <label for="exampleInputEmail1">Experience</label>
                <input type="text" class="form-control"  name="experience" required>
            </div>


            <div class="form-group col-6">
                <label for="exampleInputEmail1">Language</label>
                <input type="text" class="form-control"  name="Language" required>
            </div>
            
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
 @if(session()->has('message'))
    <div class="alert alert-success mt-5">
        {{ session()->get('message') }}
    </div>
@endif
</div>
<!-- LayoutDivs -->
</div>
</div>
</body>
@endsection
