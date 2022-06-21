@extends('layouts.app')
@section('content')
@if (session('status'))

@endif
@include('admin.adminDashBoardLayout')  
<div class="col-sm-10">


  @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
    
    @if(count($showProperty) === 0)
  <h2 class="text-center font-weight-bold text-danger"class="text-dark">No Record Found</h2>
  @else  



   <table class="table my-5">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Title</th>
      <th scope="col">Created Date</th>
      <th scope="col">Action</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    @foreach($showProperty as $showPropertyIndex)
    <tr>
      <td>{!!  $showPropertyIndex->id !!}</td>
       <td>{!!  $showPropertyIndex->title !!}</td>
      <td>{!!  $showPropertyIndex->created_at !!}</td>
      <td><a href="{{ url('admin/edit/'.$showPropertyIndex->id ) }}" class="btn btn-primary">Edit</a></td>
      <td><a href="{{ url('admin/delete-property-type/'.$showPropertyIndex->id ) }}" class="btn btn-danger">Delete</a></td>
    </tr>
    @endforeach
  </tbody>
</table>

@if(session('status'))
    <div class="alert alert-success my-4" role="alert">
        {{ session('status') }}
    </div>
    @endif
 
 @endif
</div>
<!-- LayoutDivs -->
</div>
</div>
</body>
@endsection
