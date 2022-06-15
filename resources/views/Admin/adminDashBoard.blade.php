@extends('layouts.app')
@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
@include('Admin.adminDashBoardLayout')  
<div class="col-sm-10">
    <h2 class="text-center"class="text-dark"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 15"><defs><style></style></defs><path fill="yellow" d="M8.377,1.318l2,5,6,1-4,4,1,5-5-2-5,2,1-5-4-4,5-1Z" transform="translate(-0.377 -1.318)"></path></svg>
    Welcome {{ Auth::user()->name }} </h2>
</div>
<!-- LayoutDivs -->
</div>
</div>
</body>
@endsection
