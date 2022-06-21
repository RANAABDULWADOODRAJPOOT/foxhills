@extends('layouts.app')
@section('content')
@if (session('status'))

@endif
@include('Admin.adminDashBoardLayout')  
<div class="col-sm-10">
 
 
@if(count($GeneralContents) === 0)
<h2 class="text-center font-weight-bold text-danger"class="text-dark">No Record Found</h2>
@else  


 <div class="row"> 
<div style="overflow-x: scroll;" class="col-12">

   <table  class="table my-5">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Property Name</th>
      
      <th scope="col">Description</th>
      
      <th scope="col">PropertyType</th>
      <th scope="col">Image</th>
      <th scope="col">Category</th>
      <th scope="col">Created date</th>
      <th scope="col">Action</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

   
   @foreach($GeneralContents as $GeneralContents )
    <tr>
      <td>{!! $GeneralContents->id !!}</td>
      <td>{!! $GeneralContents->productname !!}</td>
      <td>{!! substr($GeneralContents->Description, 0, 25) !!}</td>
      @if(!empty($GeneralContents->propertyType->title))
      <td class="font-weight-bold text-primary">{!! $GeneralContents->propertyType->title !!}</td>
      @endif
      <td >{!! $GeneralContents->picture !!}</td>
      <td class="font-weight-bold text-primary">{!! App\Models\AvailableProperty::getPropertyType($GeneralContents->Category) !!}</td>
      <td>{!! $GeneralContents->created_at !!}</td>
      <td>{!! $GeneralContents->Completion !!}</td>
      <td><a href="{{ url('admin/edit-general-page/'.$GeneralContents->id ) }}" class="btn btn-primary">Edit</a></td>
      <td><a href="{{ url('admin/delete-general-page/'.$GeneralContents->id  ) }}" class="btn btn-danger">Delete</a></td>
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
