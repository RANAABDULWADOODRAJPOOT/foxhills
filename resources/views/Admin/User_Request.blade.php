@extends('layouts.app')
@section('content')
@if (session('status'))

@endif
@include('Admin.adminDashBoardLayout')  
<div class="col-sm-10">


  
    
    @if(count($UserRequests) === 0)
  <h2 class="text-center font-weight-bold text-danger"class="text-dark">No Record Found</h2>
  @else  



   <table class="table my-5">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">phone</th>
      <th scope="col">description</th>
       <th scope="col">Request Type</th>
        <th scope="col">request Time</th>
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
