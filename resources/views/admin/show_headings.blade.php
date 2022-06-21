@extends('layouts.app')
@section('content')
@if (session('status'))

@endif
@include('admin.adminDashBoardLayout')  
<div class="col-sm-10">
    
  @if(count($pagedatas) === 0)
  <h2 class="text-center font-weight-bold text-danger"class="text-dark">No Record Found</h2>
  @else  


   <table class="table my-5">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">heading Name</th>
        <th scope="col">location</th>
      <th scope="col">action</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>

    @foreach($pagedatas as $pagedata)
    <tr>
      <td>{!!  $pagedata->id !!}</td>
      <td>{!!  $pagedata->heading !!}</td>
      <td>{!!   App\Models\page::getlocation($pagedata->location) !!}</td>
      <td><a href="{{ url('admin/edit_page/'.$pagedata->id ) }}"  class="btn btn-primary">Edit</a></td>
      <td><a href="{{ url('admin/delete_page/'.$pagedata->id ) }}"  class="btn btn-danger">Delete</a></td>

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
