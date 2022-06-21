@extends('layouts.app')
@section('content')
@if (session('status'))

@endif
@include('admin.adminDashBoardLayout')  
<div class="col-sm-10">
    <h2 class="text-center"class="text-dark">Add Property Type</h2>



     <form method="POST" action="{!! url('admin/update_page/'.$page->id ) !!}">
       @csrf
        <div class="row">
            <select style="height:40px;" class="form-control my-5 col-8 mx-4" name="selectCategory" id="selectCategoryById">
                <option style="display:none" value="0">select location</option>
                <option value="1">header</option>
                <option value="2">Footer</option>
            </select>
            <div class="form-group col-6">
                <label for="exampleInputEmail1">Enter The Headings</label>
                <input type="text" class="form-control"  name="headings" value="{!! $page->heading !!}">
            </div>
            <input id="setheading" type="hidden" name="location" value="{!! $page->location !!}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>



<script>    
    $( "#selectCategoryById" ).on( "change", function() {
        var a =  $('#selectCategoryById option:selected').val();
       
         
            document.getElementById("setheading").value = a;
        
    });

    $("#my-select option[name='myName']").prop('selected', true);

</script>


</div>
<!-- LayoutDivs -->
</div>
</div>
</body>
@endsection
