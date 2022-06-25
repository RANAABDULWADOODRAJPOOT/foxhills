@extends('layouts.app')
@section('content')
@if (session('status'))

@endif
@include('admin.adminDashBoardLayout')  

 <script src="https://cdn.tiny.cloud/1/1v5l1ka1kfezl9uoe9okyrtv9kzgoze381dm9wt19tr4j8nz/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<div class="col-sm-10">
    <h2 class="text-center"class="text-dark">Add Journal</h2>



     <form method="POST" action="{{url('admin/save-journals')}}"  enctype="multipart/form-data">
       @csrf
        <div class="row my-5">
           

            <div id="Propertytype" class="form-group col-6">
              <label for="exampleInputPassword1">Property Type</label>
               <select style="height:34px;" class="form-control" name="journal_type" id="selectCategoryById">
                  @foreach($category as $cat)
                  <option value="{!!  $cat->id !!}">{!!  $cat->name !!}</option>
                  @endforeach
              </select>
            </div>
             <div class="form-group col-6">
                <label for="exampleInputEmail1">Journal Title</label>
                <input type="text" class="form-control"  name="journal_title" required>
            </div>
             
            <div class="form-group col-6">
                <label for="exampleInputPassword1">Profile Image</label>
                <input style="border:none" type="file" class="form-control p-0 mt-2" name="image" required>
            </div>
             <div class="form-group col-6">
                <label for="exampleInputEmail1">Publish Date</label>
                <input type="date" class="form-control"  name="Publish_date" required>
            </div>
             <div class="form-group col-12">
                <label for="exampleInputEmail1">Description</label>
                 <textarea rows="10" type="text" class="form-control" name="description"></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
   <!--  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
  </script> -->
 @if(session()->has('message'))
    <div class="alert alert-success mt-5">
        {{ session()->get('message') }}
    </div>
@endif


@if(count($alldata) === 0)
<h2 class="text-center font-weight-bold text-danger"class="text-dark">No Record Found</h2>
@else  


 <div class="row"> 
<div class="col-12">

   <table  class="table my-5">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">image name</th>
      <th scope="col">image</th>
       <th scope="col">code</th>
      </tr>
  </thead>
  <tbody>

   
   @foreach($alldata as $data )
    <tr>
      <td>{!! $data->id !!}</td>
      <td>{!! $data->picture !!}</td>
      <td><img height="80px;" width="80px" src="<?php echo asset("assets/allimages/{$data->picture}")?>" ></td>
      <td><'img' style="margin-top:10px;margin-bottom:10px;" class="w-100 my-4" height="350px;"  src="<?php echo asset("assets/allimages/{name}")?>" ></td>
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
