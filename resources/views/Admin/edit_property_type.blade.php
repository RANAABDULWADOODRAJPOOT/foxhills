@extends('layouts.app')
@section('content')
@if (session('status'))

@endif
@include('admin.adminDashBoardLayout')  
<div class="col-sm-10">
    <h2 class="text-center"class="text-dark">Edit Property Type</h2>



     <form method="POST" action="{!! url('admin/update-property-type/'.$PropertyType->id ) !!}">
       @csrf
        <div class="row">
            <div class="form-group col-6">
                <label for="exampleInputEmail1">Update The The Property Type</label>
                <input type="text" class="form-control"  name="propertytype" value="{!! $PropertyType->title !!}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


  
</div>
<!-- LayoutDivs -->
</div>
</div>
</body>
@endsection
