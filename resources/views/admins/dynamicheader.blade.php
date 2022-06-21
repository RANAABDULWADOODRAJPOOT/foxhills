@extends('layouts.app')
@section('content')
@if (session('status'))

@endif
@include('admin.adminDashBoardLayout')  
<div class="col-sm-10">
    <h2 class="text-center"class="text-dark">Add headings Type</h2>



     <form method="POST" action="{{url('admin/save-page')}}">
       @csrf
        <div class="row">

            <select style="height:40px;" class="form-control my-5 col-8 mx-4" name="selectCategory" id="selectCategoryById">
                <option style="display:none" value="0">select location</option>
                <option value="1">header</option>
                <option value="2">Footer</option>
            </select>

            <div id="heading" class="form-group col-6 d-none">
                <label for="exampleInputEmail1">Enter The Headings</label>
                <input type="text" class="form-control"  name="headings" required>
            </div>
            <div class="form-group col-6 ">
                <input id="setheading" type="hidden" name="location">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>



  @if(session('message'))
    <div class="alert alert-success my-4" role="alert">
        {{ session('messageone') }}
    </div>
    @endif

<script>    
    $( "#selectCategoryById" ).on( "change", function() {
        var a =  $('#selectCategoryById option:selected').val();
        if(a == 1){
            $( "#heading" ).removeClass( "d-none" )
            document.getElementById("setheading").value = a;
        }
        else if(a == 2){
            $( "#heading" ).removeClass( "d-none" )
             document.getElementById("setheading").value = a;
        }
        else{
             $( "#heading" ).addClass( "d-none" )
        }
    });

    $("#my-select option[name='myName']").prop('selected', true);

</script>


</div>
<!-- LayoutDivs -->
</div>
</div>
</body>
@endsection
