<section class="web-header cf-group">

<nav class="navbar navbar-light navbar-expand-lg wrapper p-1  {!!  (Agent::isMobile()) ? 'p-4' : 'pb-0' !!}" style="font-family: Tw Cen MT, Helvetica, sans-serif !important">
<a href="/">
<img style="{!!  (Agent::isMobile()) ? 'height: 30px;' : 'height: 40px;' !!}"  src="{{asset('/assets/images/header/logo.png')}}" > 
</a>
<div>
<svg class="d-md-none" fill="#ffffff" height="26" viewBox="0 0 24 24" width="36" xmlns="http://www.w3.org/2000/svg">
<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"></path>
<path d="M0 0h24v24H0z" fill="none"></path>
</svg>
<button class="navbar-toggler p-0" data-toggle="collapse" data-target="#navbarCollapse">
<svg fill="#ffffff" height="{!!  (Agent::isMobile()) ? '26' : '36' !!}" viewBox="0 0 24 24" width="36" xmlns="http://www.w3.org/2000/svg">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"></path>
</svg>
</button>
</div>





<div class="collapse navbar-collapse m-0 p-0 ml-auto" id="navbarCollapse">
<div class=" ml-auto">
<div class="d-md-block d-none" style="text-align-last: end; padding-right: 10px;">
<svg style="margin-bottom: -5px;" class="mt-1" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill=""></path><path fill="#999" d="M17 1.01L7 1c-1.1 0-2 .9-2 2v18c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V3c0-1.1-.9-1.99-2-1.99zM17 19H7V5h10v14z"></path></svg>
<a  style="color: #999; text-decoration: none; font-size: 14px;" href="tel:+971 48 89 67 77">+971 48 89 67 77</Span>
{{-- <a class="mx-3"  style="color: #999; text-decoration: none; font-size: 12px;"> | </Span>
<a  style="color: #999; text-decoration: none; font-size: 14px;">Login</a> --}}
</div>
<ul class="navbar-nav ml-auto">



  @foreach($allHeadings as $allHeading)
  @if($allHeading->location == 1)
  <li  clas="navbar-item dropdown">
    <a href="{!! url($allHeading->heading.'/'.$allHeading->id) !!}"  data-id-page="{!! $allHeading->id  !!}"  class="nav-link heading   menu-item {!!  (Agent::isMobile()) ? 'mobilefont' : '' !!}" >{!! $allHeading->heading  !!}</a>
   
    @if(count($allHeading->propertydata)>0)
    <div style="margin-top: -2px;" id="tab_{!! $allHeading->id  !!}"   class="dropdown-menu banner cover p-2 pt-4">
      <div class="d-flex px-2">
        <div class="mega-dropdown-column {!!  (Agent::isMobile()) ? '' : '' !!} px-10 d-flex col-12" style="overflow: clip;">
         
          <div class="col-md-3 col-12">
            
            @foreach($allHeading->propertydata as $type)
            <ul style="list-style-type: none;">
                <li style="font-size: 18px;"><a class="text-muted" href="{!! url($allHeading->id.'/'.$type->propertyType->id.'/'.'1') !!}">{!! $type->propertyType->title !!}</a></li>
            </ul>
            @endforeach
           </div>



           @foreach($allHeading->propertydata as $type)
           @if($loop->index < 2)
          <div class="text-left col-4  d-md-block d-none ">
            <a href="{!! url('details/'.$type->id) !!}">
            <img  style="height:60%; width:100%" srcset="https://do84cgvgcm805.cloudfront.net/8128/100/d3d17a79643f2fe218375529093d12d7e27bacf772510b50e03aae1fae5a6973.jpg 100w, https://do84cgvgcm805.cloudfront.net/8128/375/d3d17a79643f2fe218375529093d12d7e27bacf772510b50e03aae1fae5a6973.jpg 375w" sizes="auto" alt="Fully Upgraded, Chic Design Apartment with Dubai Fountain Views" class="full-width-responsive brd" loading="lazy" width="375" height="282">
            <p class="mb-0 font-weight-bold mt-3 text-white text-left">{!! $type->productname !!}</p>
            <p class="mb-0 text-muted text-left">AED {!! number_format($type->Price, 0, ',', ','); !!}</p>
          </a>
          </div>
          @else
          @break
          @endif
           @endforeach



        </div>
      </li>
      @else
      @continue
      @endif
      @endif
      @endforeach
<li clas="navbar-item">
<a href="{!! url('sale') !!}" class="nav-link menu-item {!!  (Agent::isMobile()) ? 'mobilefont' : '' !!}">Sell</a>
</li>
<li clas="navbar-item">
<a href="{!! url('Journal') !!}" class="nav-link menu-item {!!  (Agent::isMobile()) ? 'mobilefont' : '' !!}">Journals</a>
</li>
</ul>
</div>
<a style="padding-right: 0px;padding-left: 0px;" class="nav-link menu-item P-0 d-md-none closeheader {!!  (Agent::isMobile()) ? 'mobilefont' : '' !!} ">Close</a>
</div>
</nav>  



</section>




