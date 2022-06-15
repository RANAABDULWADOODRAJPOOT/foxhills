@extends('layouts.app')
@section('content')
<!-- @if (session('status'))

@endif -->
@include('Admin.adminDashBoardLayout')  

<div class="col-sm-10">
    <h2 class="text-center"class="text-dark">Add Pictures</h2>
    <form method="POST" action="{{url('admin/save-multipicblog')}}"  enctype="multipart/form-data">
       @csrf
        <div class="row my-5">
         <div class="col-12">
            <h3 style="margin-top: 20px;">Upload multiple picture of blogs</h3>
            
         

           <input style="border:none;margin-top: 30px;" type="file" class="form-control p-0" name="data[]" multiple="multiple" required>

          
           
        <button type="submit" class="btn btn-primary my-4">upload</button>
    </div>
</div>
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
