<head>
  <title>LuxHabitate</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
    .nav>li>a:focus, .nav>li>a:hover{
      background-color: grey;
      color: black;
    }
  </style>
</head>
<body>

  <script   src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script  src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
  <script  src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<nav class="navbar navbar-inverse visible-xs">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul style="display: block;" class="nav navbar-nav">
        <li class="active"><a href="#">Dashboard</a></li>
        <li><a href="#">Age</a></li>
        <li><a href="#">Gender</a></li>
        <li><a href="#">Geo</a></li>
      </ul>
    </div>
  </div>
</nav>

<div style="margin-top:-36px;" class="container-fluid">
  <div>
    <div style="border-radius: 10px; background-color: black; height:800px" class="col-sm-2  sidenav hidden-xs">
      <img class="mt-5 mb-4"  style="{!!  (Agent::isMobile()) ? 'height: 30px;' : 'height: 40px;' !!}"  src="{!! config('urls.web_cdn_url') . '/assets/images/header' !!}/logo.png" > 
      <ul style="display:block;" class="nav nav-pills nav-stacked">
      
        <li><a style="font-weight: 700;"  class="text-light {{ Request::is('admin/create-page') ? 'active' : '' }}" href="{!! url('admin/create-page') !!}">Create Menu</a></li>
        <li><a style="font-weight: 700;" class="text-light {{ Request::is('admin/show-pages') ? 'active' : '' }}" href="{!! url('admin/show-pages') !!}">Show Menu</a></li>
        <li><a style="font-weight: 700;" class="text-light {{ Request::is('admin/add-property-type') ? 'active' : '' }}" href="{!! url('admin/add-property-type') !!}">Add Property Type</a></li>
        <li><a style="font-weight: 700;" class="text-light {{ Request::is('admin/show-property-type') ? 'active' : '' }}" href="{!! url('admin/show-property-type') !!}">Show Property Type</a></li>
        <li><a style="font-weight: 700;" class="text-light {{ Request::is('admin/upload-items') ? 'active' : '' }}" href="{!! url('admin/upload-items') !!}">Add Listing</a></li>
        <li><a style="font-weight: 700;" class="text-light {{ Request::is('admin/show-upload-items') ? 'active' : '' }}" href="{!! url('admin/show-upload-items') !!}">Show Listing</a></li>
        {{-- <li><a style="font-weight: 700;" class="text-light" href="{!! url('admin/show-general-page') !!}">show Data General pages</a></li> --}}
        <li><a style="font-weight: 700;" class="text-light {{ Request::is('admin/upload-journals') ? 'active' : '' }}" href="{!! url('admin/upload-journals') !!}">Add Journals</a></li>
          {{-- <li><a style="font-weight: 700;" class="text-light" href="{!! url('admin/multi-journals') !!}">Upload mutiple picture Journals</a></li> --}}
        <li><a style="font-weight: 700;" class="text-light {{ Request::is('admin/show-journals') ? 'active' : '' }}" href="{!! url('admin/show-journals') !!}">Show Journals</a></li>
        <li><a style="font-weight: 700;" class="text-light {{ Request::is('admin/addagent') ? 'active' : '' }}" href="{!! url('admin/addagent') !!}">Add Agent</a></li>
          <li><a style="font-weight: 700;" class="text-light {{ Request::is('admin/showagent') ? 'active' : '' }}" href="{!! url('admin/showagent') !!}">Show Agents</a></li>
        <li><a style="font-weight: 700;" class="text-light {{ Request::is('admin/show-request') ? 'active' : '' }}" href="{!! url('admin/show-request') !!}">Show Request</a></li>
        <li><a style="font-weight: 700;" class="text-light {{ Request::is('logout') ? 'active' : '' }}" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
        </a></li>
     </ul><br>
    </div>
    <br>