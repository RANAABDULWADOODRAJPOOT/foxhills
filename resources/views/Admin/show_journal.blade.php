@extends('layouts.app')
@section('content')
@if (session('status'))

@endif
@include('Admin.adminDashBoardLayout')  
<div class="col-sm-10">
    
  @if(count($Journals) === 0)
  <h2 class="text-center font-weight-bold text-danger"class="text-dark">No Record Found</h2>
  @else  


   <table class="table my-5">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">journal type</th>
      <th scope="col">journal title</th>
      <th scope="col">picture</th>
      <th scope="col">Publish_date</th>
      <th scope="col">description</th>
      <th scope="col">created_at</th>
      <th scope="col">action</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>

    @foreach($Journals as $Journal)
    <tr>
      <td>{!!  $Journal->id !!}</td>
      <td>{!!  $Journal->journal_type !!}</td>
      <td>{!!  $Journal->journal_title !!}</td>
      <td>{!!  $Journal->picture !!}</td>
      <td>{!!  $Journal->Publish_date !!}</td>
      <td>{!!  $Journal->description !!}</td>
      <td>{!!  $Journal->created_at !!}</td>
       <td><a href="{{ url('admin/edit_journal/'.$Journal->id ) }}" class="btn btn-primary">Edit</a></td>
       <td><a href="{{ url('admin/delete_journal/'.$Journal->id ) }}"  class="btn btn-danger">Delete</a></td>

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
