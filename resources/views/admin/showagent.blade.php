@extends('layouts.app')
@section('content')
@if (session('status'))

@endif
@include('admin.adminDashBoardLayout')  
<div class="col-sm-10">
    
  @if(count($showagent) === 0)
  <h2 class="text-center font-weight-bold text-danger"class="text-dark">No Record Found</h2>
  @else  


   <table class="table my-5">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">agentname</th>
      <th scope="col">Licence Number</th>
      <th scope="col">Profile Image</th>
      <th scope="col">Desigination</th>
      <th scope="col">action</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>

    @foreach($showagent as $showagentobj)
    <tr>
      <td>{!!  $showagentobj->id !!}</td>
      <td>{!!  $showagentobj->agentname !!}</td>
      <td>{!!  $showagentobj->Licence !!}</td>
      <td>{!!  $showagentobj->picture !!}</td>
      <td>{!!  $showagentobj->Desigination !!}</td>
       <td><a href="{{ url('admin/editaddagent/'.$showagentobj->id ) }}" class="btn btn-primary">Edit</a></td>
       <td><a href="{{ url('admin/deleteagent/'.$showagentobj->id ) }}"  class="btn btn-danger">Delete</a></td>

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
