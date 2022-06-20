@extends('layouts.app')
@section('content')
@if (session('status'))

@endif
@include('Admin.adminDashBoardLayout')  
<div class="col-sm-10">
 
 
@if(count($AvailableProperties) === 0)
<h2 class="text-center font-weight-bold text-danger"class="text-dark">No Record Found</h2>
@else  


 <div class="row"> 
<div style="overflow-x: scroll;" class="col-12">

   <table  class="table my-5">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Property Name</th>
      <th scope="col">City</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      {{-- <th scope="col">Area</th> --}}  <th scope="col">Location</th>
      <th scope="col">Bedrooms</th>
      {{-- <th scope="col">length</th> --}}  <th scope="col">Area</th>
      <th scope="col">Speciality</th>
      <th scope="col">PropertyType</th>
      <th scope="col">Image</th>
      <th scope="col">Category</th>
      <th scope="col">Created date</th>
       <th scope="col">Completion</th>
       <th scope="col">bannerimage</th>
      <th scope="col">Agent name</th>
      <th scope="col">Action</th>
      <th scope="col">Action</th>
       <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

   
   @foreach($AvailableProperties as $availableProperty )
    <tr>
      <td>{!! $availableProperty->id !!}</td>
      <td>{!! $availableProperty->productname !!}</td>
      <td>{!! $availableProperty->city !!}</td>
      <td>{!! substr($availableProperty->Description, 0, 25) !!}</td>
      <td>{!! $availableProperty->Price !!}</td>
      <td>{!! $availableProperty->Area !!}</td>
      <td>{!! $availableProperty->Bedrooms !!}</td>
      <td>{!! $availableProperty->length !!}</td>
      <td>{!! $availableProperty->Speciality !!}</td>
      @if(!empty($availableProperty->propertyType->title))
      <td class="font-weight-bold text-primary">{!! $availableProperty->propertyType->title !!}</td>
      @endif
      <td >{!! $availableProperty->picture !!}</td>
      <td class="font-weight-bold text-primary">{!! App\Models\AvailableProperty::getPropertyType($availableProperty->Category) !!}</td>
      <td>{!! $availableProperty->created_at !!}</td>
      <td>{!! $availableProperty->Completion !!}</td>
      <td>{!! $availableProperty->bannerimage !!}</td>
      @if(!empty($availableProperty->agent))
       <td class="font-weight-bold text-primary">{!! App\Models\AvailableProperty::getagentname($availableProperty->agent) !!}</td>
      @else
          <td class="font-weight-bold text-primary">no agent</td>
      @endif
      <td><a href="{{ url('admin/edit-upload-items/'.$availableProperty->id ) }}" class="btn btn-primary">Edit</a></td>
      <td><a href="{{ url('admin/delete-upload-items/'.$availableProperty->id  ) }}" class="btn btn-danger">Delete</a></td>
      <td><a href="{{ url('admin/multiplePictures/'.$availableProperty->id  ) }}" class="btn btn-success">Add multiple pictures</a></td>
     </tr>
         @endforeach

  </tbody>
</table>

</div>
 </div>
 @endif
</div>
<!-- LayoutDivs -->
</div>
</div>
</body>
@endsection
