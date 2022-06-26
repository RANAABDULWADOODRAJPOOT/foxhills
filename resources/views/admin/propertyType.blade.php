@extends('layouts.app')
@section('content')
@if (session('status'))

@endif
@include('admin.adminDashBoardLayout')  
<div class="col-sm-10">
    <h2 class="text-center"class="text-dark">Add Sub pages</h2>



     <form method="POST" action="{{url('admin/save-property-type')}}">
       @csrf
        <div class="row">
            <div class="form-group col-6">
                <label for="exampleInputEmail1">Enter The Sub page name </label>
                <input type="text" class="form-control"  name="propertytype" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  @if(session('status'))
    <div class="alert alert-success my-4" role="alert">
        {{ session('status') }}
    </div>
    @endif
</div>
<!-- LayoutDivs -->
</div>
</div>
</body>
@endsection
