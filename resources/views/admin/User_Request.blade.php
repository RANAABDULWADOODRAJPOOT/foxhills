@extends('layouts.app')
@section('content')
@if (session('status'))

@endif
@include('admin.adminDashBoardLayout')  
<div class="col-sm-10">


  
    
    @if(count($UserRequests) === 0)
  <h2 class="text-center font-weight-bold text-danger"class="text-dark">No Record Found</h2>
  @else  


<a href={!! url('admin/downloadrequests')!!}><button style="float: right; margin: 10px; background: black; color: white; border: 0px solid;">Download Requests</button></a>
   <table class="table my-5">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Description</th>
       <th scope="col">Request Type</th>
        <th scope="col">Request Time</th>
    </tr>
  </thead>
  <tbody>

    @foreach($UserRequests as $UserRequest)
    <tr>
      <td>{!!  $UserRequest->id !!}</td>
      <td>{!!  $UserRequest->name !!}</td>
      <td>{!!  $UserRequest->email !!}</td>
      <td>{!!  $UserRequest->phone !!}</td>
      <td>{!!  $UserRequest->description !!}</td>
      <td>{!!  $UserRequest->user_request_type !!}</td>
      <td>{!!  $UserRequest->created_at !!}</td>
     </tr>
    @endforeach
  </tbody>
</table>


 
 @endif
</div>
<!-- LayoutDivs -->
</div>
</div>
</body>
@endsection
