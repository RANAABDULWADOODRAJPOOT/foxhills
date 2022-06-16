@extends('lux_habitate')
@section('content')
@if( ! Agent::isMobile())
@include('partials.homeScreenFilter')
@endif
{{-- <section class="container-fluid">
	<div class="row">
		<div  class="col-12 text-center m-0 p-0">
			<img style="z-index: -1; " class="img-fluid w-100 m-0 p-0 {!!  (Agent::isMobile()) ? 'bannerheight' : '' !!}"  src="{!! config('urls.web_cdn_url') . 'assets/allimages' !!}/{!! $AvailableProperty->picture  !!}">
		    @if(Agent::isMobile())
			<div style="margin-top:-200px">
				<p style="font-size: 20px;" class="gallery-title text-light">FEATURED PROPERTY</p>
				<h5 style="margin-top:5px;"  class="gallery-title text-light line-height">{!! substr($AvailableProperty->productname, 0, 25) !!}</h5>
				<p style="font-size: 20px; margin-bottom: 5px;" class="gallery-title text-light">{!! $AvailableProperty->Price !!}</p>
				<button class="btn btn-slider">View the Property</button>
			</div>
			@else
			<div style="margin-top:-350px">
				<p style="font-size: 25px;" class="gallery-title text-light">FEATURED PROPERTY</p>
				<h5 style="font-size: 75px;" class="gallery-title text-light my-4">{!! substr($AvailableProperty->productname, 0, 25) !!}</h5>
				<p style="font-size: 25px;" class="gallery-title text-light">{!! $AvailableProperty->Price !!}</p>
				<button  class="btn btn-slider">View the Property</button>
			</div>
			@endif
		
		</div>
	</div>
</section>
<section style="{!!  (Agent::isMobile()) ? 'margin-top:60px;' : 'margin-top:170px;' !!}" class="container-fluid text-center">
	<div class="row justify-content-center  text-center">
		<div class="container text-center">
			<h5  class="text-light {!!  (Agent::isMobile()) ? 'line-height' : '' !!}" style='font-family: "Tw Cen MT", Helvetica, sans-serif;font-size:24px'>The Address For Luxury Property</h5>
			<hr style="border-top:1px solid white;">
			<p class="{!!  (Agent::isMobile()) ? 'mobilefont' : ' text-grey' !!}" style="font-family:Questrial, sans-serif;font-size:16px;">LUXHABITAT Sotheby's International Realty is Dubai's only high-end real estate brokerage company setting extraordinary records in the marketing and selling of quality, design-led residential properties. <br></p>
			<p class="{!!  (Agent::isMobile()) ? 'mobilefont' : 'text-grey' !!}" style="font-family:Questrial, sans-serif;font-size:16px;">Our record-breaking deals and global reach has combined forces on a strong marketing and technology platform to create the most influential luxury real estate firm in the region is supported by the world's largest global realty brand.</p>
		</div>
	</div>
</section>
<section class="container">
<div class="row">
<section class="col-md-10 my-3 offset-md-1 col-12 ">
	<div class="row justify-content-center {!!  (Agent::isMobile()) ? 'd-none' : '' !!}">
		<div class="col-md-3  col-12 text-center">
			<a>
			<div style="border:2px solid #222" class="options" >
				<img class=" img-fluid w-100" src="{!! config('urls.web_cdn_url') . 'assets/homeimages' !!}/one.jpg" >
				<h5 class="my-3 text-light">Luxury Sales</h5>
			</div>
		</a>
		</div>
		<div class="col-md-3  col-12 text-center d-md-block d-none">
			<a>
			<div style="border:2px solid #222" class="options" >
				<img class="img-fluid w-100"src="{!! config('urls.web_cdn_url') . 'assets/homeimages' !!}/two.jpg" >
				<h5 class="my-3 text-light">Luxury Rent</h5>
			</div>
		</a>
		</div>
		<div class="col-md-3  col-12 text-center">
			<a>
			<div style="border:2px solid #222" class="options" >
				<img class=" img-fluid w-100" src="{!! config('urls.web_cdn_url') . 'assets/homeimages' !!}/three.jpg" >
				<h5 class="my-3 text-light">List Your Home</h5>
			</div>
		</a>
		</div>
		<div class="col-md-3 col-12 text-center">
			<a>
			<div style="border:2px solid #222" class="options">
				<img class=" img-fluid w-100" src="{!! config('urls.web_cdn_url') . 'assets/homeimages' !!}/four.jpg" >
				<h5 class="my-3 text-light">The Journal</h5>
			</div>
		</a>
		</div>
	</div>


	<div class="col-12 d-md-none ">
		<div style="border-bottom: 1px solid #222;" class="d-flex justify-content-between">
			<h5 class="mb-3 text-light">Luxury Sales</h5>
			<svg fill="#000000" height="36" viewBox="0 0 24 24" width="36" xmlns="http://www.w3.org/2000/svg">
				<path fill="white" d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"></path>
				<path d="M0-.25h54v24H0z" fill="none"></path>
			</svg>
		</div>
		<div style="border-bottom: 1px solid #222;" class="d-flex justify-content-between">
			<h5 class="mb-3 text-light">Luxury Rentals</h5>
			<svg fill="#000000" height="36" viewBox="0 0 24 24" width="36" xmlns="http://www.w3.org/2000/svg">
				<path fill="white" d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"></path>
				<path d="M0-.25h54v24H0z" fill="none"></path>
			</svg>
		</div>
		<div style="border-bottom: 1px solid #222;" class="d-flex justify-content-between">
			<h5 class="mb-3 text-light">List Your Home</h5>
			<svg fill="#000000" height="36" viewBox="0 0 24 24" width="36" xmlns="http://www.w3.org/2000/svg">
				<path fill="white" d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"></path>
				<path d="M0-.25h54v24H0z" fill="none"></path>
			</svg>
		</div>
		<div style="border-bottom: 1px solid #222;" class="d-flex justify-content-between">
			<h5 class="mb-3 text-light">The Journal</h5>
			<svg fill="#000000" height="36" viewBox="0 0 24 24" width="36" xmlns="http://www.w3.org/2000/svg">
				<path fill="white" d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"></path>
				<path d="M0-.25h54v24H0z" fill="none"></path>
			</svg>
		</div>
	</div>

@if(!empty($typeone))
<div class="row">
	<div class="col-6 my-4 p-0">
		@foreach($typeone as $saleVilla)
		<h2 class="text-light">FEATURED {!! App\Models\PropertyType::getpropertytypeviaid($saleVilla->property_type_id) !!}</h2>
		@break;
		@endforeach
		
	</div>
	<div class="col-6 my-4 p-0">
		<button class="btn btn-sm btn-filter active float-right btn-filter-active" onclick="filterSelection('all')"> New to Market</button>
	  <button class="btn btn-sm btn-filter float-right" onclick="filterSelection('cars')"> Price Reduction</button>
	  <button class="btn btn-sm btn-filter float-right" onclick="filterSelection('animals')"> Featured</button>
	</div>

</div>
		@if(Agent::isMobile())
	<div  class="row flex-row d-flex flex-nowrap horizontal-scroll">
		@else
		<div style="border-bottom: 2px solid #222;" class="row w-100 my-5">
			@endif

     @foreach($typeone as $saleVilla)
		<div  class="col-md-4 col-12">
			<a href="{{ url('details/'.$saleVilla->id ) }}">
			<div>
				<img style="height: 250px;"  class=" img-fluid w-100" src="{!! config('urls.web_cdn_url') . 'assets/allimages' !!}/{!! $saleVilla->picture  !!}" >
				<div>
					<h3 class="mt-3 mb-2 text-light">{!! substr($saleVilla->productname, 0, 25) !!}</h3>
					<p class="mb-0 text-grey">{!! $saleVilla->Area !!}</p>
					<p class="mb-0 text-grey"><Span>{!! $saleVilla->propertyType->title !!} | {!! $saleVilla->Bedrooms !!} | {!! $saleVilla->length !!}</Span></p>
					<h4 class="mt-2 mb-3 text-light">AED {!! $saleVilla->Price !!}</h4>
				</div>
			</div>
		</a>
		</div>
	@endforeach

	</div>
		@endif
@if(!empty($typetwo))
<div class="row">
	<div class="col-6 my-4 p-0">
		@foreach($typetwo as $saleApartment)
		<h2 class="text-light">FEATURED {!! App\Models\PropertyType::getpropertytypeviaid($saleApartment->property_type_id) !!}</h2>
		@break;
		@endforeach
	</div>

	<div class="col-6 my-4 p-0">
		<button class="btn btn-sm btn-filter active float-right btn-filter-active" onclick="filterSelection('all')"> New to Market</button>
	  <button class="btn btn-sm btn-filter float-right" onclick="filterSelection('cars')"> Price Reduction</button>
	  <button class="btn btn-sm btn-filter float-right" onclick="filterSelection('animals')"> Featured</button>
	</div>
</div>
	@if(Agent::isMobile())
	<div  class="row flex-row d-flex flex-nowrap horizontal-scroll">
		@else
		<div style="border-bottom: 2px solid #222;" class="row w-100 my-5">
			@endif

			@foreach($typetwo as $saleApartment)
			<div class="col-md-4  col-12">
				<a href="{{ url('details/'.$saleApartment->id ) }}">
					<div>
						<img style="height: 250px;"  class=" img-fluid w-100" src="{!! config('urls.web_cdn_url') . 'assets/allimages' !!}/{!! $saleApartment->picture  !!}" >
						<div>
							<h3 class="mt-3 mb-2 text-light">{!! substr($saleApartment->productname, 0, 25) !!}</h3>
							<p class="mb-0 text-grey">{!! $saleApartment->Area !!}</p>
							<p class="mb-0 text-grey"><Span>{!! $saleApartment->propertyType->title !!} | {!! $saleApartment->Bedrooms !!} | {!! $saleApartment->length !!}</Span></p>
							<h4 class="mt-2 mb-3 text-light">AED {!! $saleApartment->Price !!}</h4>
						</div>
					</div>
				</a>
			</div>
			@endforeach

	</div>
		@endif
	@if(!empty($typetwo))
	<div class="col-12 my-4 p-0">
		@foreach($typethree as $salepenthouses)
		{{-- <h2 class="text-light">FEATURED {!! App\Models\PropertyType::getpropertytypeviaid($salepenthouses->property_type_id) !!}</h2> --}}
		{{-- <h2 class="text-light">FEATURED DEVELOPMENTS</h2>
		@break;
		@endforeach
	</div>
	
	@if(Agent::isMobile())
	<div  class="row flex-row d-flex flex-nowrap horizontal-scroll">
		@else
		<div  class="row w-100 my-5">
			@endif
			@foreach($typethree as $salepenthouses)
			<div class="col-md-4  col-12">
			<a href="{{ url('details/'.$salepenthouses->id ) }}">
					<div>
						<img style="height: 250px;"  class=" img-fluid w-100" src="{{ asset('assets/allimages/'.$salepenthouses->picture) }}" >
						<div>
							<h3 class="mt-3 mb-1 text-light">{!! substr($salepenthouses->productname, 0, 25) !!}</h3>
							<p class="mb-1 text-grey">{!! $salepenthouses->Area !!}</p>
							{{-- <p class="mb-0 text-grey"><Span>{!! $salepenthouses->propertyType->title !!} | {!! $salepenthouses->Bedrooms !!} | {!! $salepenthouses->length !!}</Span></p>
							<h4 class="mt-2 mb-3 text-light">AED {!! $salepenthouses->Price !!}</h4> --}}
						{{-- </div>
					</div>
				</a>
			</div>
			@endforeach
			<br />
			@foreach($typethree as $salepenthouses)
			<div class="col-md-4 col-12">
			<a href="{{ url('details/'.$salepenthouses->id ) }}">
					<div>
						<img style="height: 250px;"  class=" img-fluid w-100" src="{{ asset('assets/allimages/'.$salepenthouses->picture) }}" >
						<div>
							<h3 class="mt-3 mb-1 text-light">{!! substr($salepenthouses->productname, 0, 25) !!}</h3>
							<p class="mb-1 text-grey">{!! $salepenthouses->Area !!}</p>
							{{-- <p class="mb-0 text-grey"><Span>{!! $salepenthouses->propertyType->title !!} | {!! $salepenthouses->Bedrooms !!} | {!! $salepenthouses->length !!}</Span></p>
							<h4 class="mt-2 mb-3 text-light">AED {!! $salepenthouses->Price !!}</h4> --}}
						{{-- </div>
					</div>
				</a>
			</div>
			@endforeach
	</div>

	
	
		@endif

		
		
	<div style="border-top: 1px solid #999 ;border-bottom: 1px solid #999 " class="row justify-content-center my-2">
		<div class="col-md-8  col-12 my-md-5 my-2">
			<h3 class="text-light">THE EXPERTS</h3>
			<P class="text-grey mt-3">Our Luxury Sales Specialists will offer you the best of services and expertise to keep in mind before buying or selling your property. Each of them specialise in at least one area in Dubai and know it from a hyperlocal level. Their networking and negotiating skills will ensure that you get the results you want - whether it's a sound property investment, purchasing a property or getting the right price for your property.</P>
			<a  href="agents" style="border: 1px solid white; border-radius: 5px; color: BLACK; background:white;" class="btn btn-sm my-3">FIND AN AGENT</a>
		</div>
		<div class="col-md-4  col-12 my-md-5 my-2">
			<div  >
				<img class="img-fluid w-100"src="{!! config('urls.web_cdn_url') . 'assets/homeimages' !!}/expert.jpg" >
			</div>
		</div>
	</div>
<div class="row">
	<div class="col-12 my-1 p-0">
			<h3 class="text-light">THE JOURNAL</h3>
			<h5 style="color: #999">The online journal of luxury homes, design, interiors, art and style</h5>
		</div>
	@if(Agent::isMobile())
	<div  class="row flex-row d-flex flex-nowrap horizontal-scroll">
		@else
		<div class="row">
			@endif
		
			@foreach($Journals as $Journal)
			<div class="col-md-4  col-12 mb-3">

				<img style="height: 250px;" class=" img-fluid w-100" src="{!! config('urls.web_cdn_url') . 'assets/allimages' !!}/{!! $Journal->picture !!}" >
				<div>
					<p class="mb-0 text-grey mt-3">{!! $Journal->Publish_date !!}</p>
					<h3 class="mt-3 mb-2 text-light">{!! $Journal->journal_title !!}</h3>
					<p class="mb-0 text-grey">{!! substr($Journal->description,0,300) !!} </p>
				</div>

			</div>
			
			@endforeach
			<div class="col-md-4  col-12">
				<a href="{!! url('Journal/'.$Journal->id ) !!}" style="border: 1px solid white; border-radius: 2px; color: black; background:white;" class="btn btn-sm my-4">View ALL Articles</a>
			</div>


	</div>
	</div>
</div>
</section>  --}}




























<main id="content" class="pw100" style="display:table;">

  
	@if(!empty($AvailableProperty))
	@if(!empty($AvailableProperty->bannerimage))
	<section id="featured-properties" class="mrg-bottom-60 mrg-ignore-mobile">
		<div class="gallery cover">
			<span class="gallery-item">
				<div class="pw100 ph100 zoom-out" style="background-size:cover;">
					<img src="{!! config('urls.web_cdn_url') . 'assets/allimages' !!}/{!! $AvailableProperty->bannerimage  !!}" sizes="100vw" alt="Penthouse in Business Bay" width="1920px" height="1444px">
				</div>
				<div class="gallery-text text-center">
					<div class="inner">
						<p class="f18 tw white tablet">FEATURED PROPERTY</p><h2 class="gallery-title">{!! substr($AvailableProperty->productname, 0, 25) !!}</h2><p class="f18 white">AED {!! number_format($AvailableProperty->Price, 3, ',', ','); !!}</p>
						<a href="{{ url('details/'.$AvailableProperty->id ) }}" class="gallery-btn">View the property</a>
					</div>
				</div>
			</span>
		</div>
	</section>
	@endif
	@endif



	<section style="margin-top: 130px;" class="wrapper">
	<div class="tablet column-66 text-center mrg-left-auto mrg-right-auto mrg-bottom-60">
	<header class="mrg-bottom-20 pdg-left-30 pdg-right-30">
	<h2 class="f24 tw white">The Address For Luxury Property</h2>
	<div class="brd-top brd-white mrg-top-10 mrg-left-30 mrg-right-30"><div>
	</div></div></header>
	<div class="f16 lh24"><p>LUXHABITAT Sotheby's International Realty is Dubai's only high-end real estate brokerage company setting extraordinary records in the marketing and selling of quality, design-led residential properties. <br></p><p>
	Our record-breaking deals and global reach has combined forces on a strong marketing and technology platform to create the most influential luxury real estate firm in the region is supported by the world's largest global realty brand.</p></div>
	</div>
	</section>
	<section id="feature-items" class="wrapper">
	<div class="pw100 mrg-bottom-60">
	<div class="cf-group">
	<div class="column-25 left pdg-right-15 pdg-ignore-mobile text-center cf-group">
	<a class="home-banner pw100 cf-group left" href="/">
	<img src="assets/homeimages/one.jpg" class="full-width-responsive" loading="lazy" alt="Buy a property in United Arab Emirates" width="280" height="280">
	<div class="btn-banner">
	<span>Luxury Sales</span>
	<svg fill="#000000" height="36" viewBox="0 0 24 24" width="36" xmlns="http://www.w3.org/2000/svg">
	<path d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"></path>
	<path d="M0-.25h24v24H0z" fill="none"></path>
	</svg> </div>
	</a>
	</div>
	<div class="column-25 left pdg-left-5 pdg-right-10 pdg-ignore-mobile text-center cf-group">
	<a class="home-banner pw100 cf-group left" href="/">
	<img src="assets/homeimages/two.jpg" class="full-width-responsive" loading="lazy" alt="Rent a property in United Arab Emirates" width="280" height="280">
	<div class="btn-banner">
	<span>Luxury Rentals</span>
	<svg fill="#000000" height="36" viewBox="0 0 24 24" width="36" xmlns="http://www.w3.org/2000/svg">
	<path d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"></path>
	<path d="M0-.25h24v24H0z" fill="none"></path>
	</svg> </div>
	</a>
	</div>
	<div class="column-25 left pdg-left-10 pdg-right-5 pdg-ignore-mobile text-center cf-group">
	<a class="home-banner pw100 cf-group left" href="/">
	<img src="assets/homeimages/three.jpg" class="full-width-responsive" loading="lazy" alt="Sell your property with Luxhabitat" width="280" height="280">
	<div class="btn-banner">
	<span>List Your Home</span>
	<svg fill="#000000" height="36" viewBox="0 0 24 24" width="36" xmlns="http://www.w3.org/2000/svg">
	<path d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"></path>
	<path d="M0-.25h24v24H0z" fill="none"></path>
	</svg> </div>
	</a>
	</div>
	<div class="column-25 left pdg-left-10 pdg-right-5 pdg-ignore-mobile text-center cf-group">
	<a class="home-banner pw100 cf-group left" href="/">
	<img src="assets/homeimages/four.jpg" class="full-width-responsive" loading="lazy" alt="The online journal of luxury homes, design, interiors, art and style" width="280" height="280">
	<div class="btn-banner">
	<span>The Journal</span>
	<svg fill="#000000" height="36" viewBox="0 0 24 24" width="36" xmlns="http://www.w3.org/2000/svg">
	<path d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"></path>
	<path d="M0-.25h24v24H0z" fill="none"></path>
	</svg> </div>
	</a>
	</div>
	</div>
	</div>
	</section>
	<section id="listings" class="wrapper">
	<div class="home-section cf-group mrg-bottom-60">
	<header class="home-section-header cf-group">
     @foreach($typeone as $saleVilla)
     <h2 class="title mrg-top-auto" style="white-space: nowrap;">FEATURED {!! App\Models\PropertyType::getpropertytypeviaid($saleVilla->property_type_id) !!}</h2>
     @break;
     @endforeach
	<span class="btn-group cf-group selector">
	<a id="vilaone" class="btn compact selected tab-trigger">New To Market</a>
	<a id="vilatwo" class="btn compact tab-trigger">Price Reduction</a>
	<a id="vilathree" class="btn compact  tab-trigger">Featured</a>
	</span>
	</header>
	<div class="cf-group relative">
	<div class="tab active">
	<div class="mobile-slider">
	<div class="list inner">
	    
	     @foreach($typeone as $saleVilla)
    @if($loop->index < 3)
	<div class="column-33 property villasone">
	<article id="property_10411" class="list-item no-brd mrg-auto img-override">
	<a href="{{ url('details/'.$saleVilla->id ) }}" class="cf-group">
	<div class="no-brd">
	<img src="{!! config('urls.web_cdn_url') . 'assets/allimages' !!}/{!! $saleVilla->picture  !!}" class="full-width-responsive brd" loading="lazy" width="375" height="282">
	<span class="override animated text-left pdg-20">
	<h2 class="white normalcase mrg-top-auto">Brand New</h2>
	<p class="white f16 lh20 text-truncate">{!! $saleVilla->Description !!}</p>
	<p class="f16 lh20 white mrg-top-10">Learn more ›</p>
	</span>
	</div>
	<div class="pdg-top-10 pdg-bottom-10">
	<p class="f18 lh18 uppercase white ellipsis mrg-bottom-10">{!! substr($saleVilla->productname, 0, 25) !!}</p>
	<p class="f14 lh14 ellipsis mrg-bottom-5">
	{!! $saleVilla->Area !!}</p>
	<ul class="f14 lh14 ellipsis features ellipsis mrg-bottom-10">
	<li class="feature left">{!! $saleVilla->propertyType->title !!}</li>
	<li class="feature left"><span class="separator"></span>{!! $saleVilla->Bedrooms !!} BD</li><li class="feature left"><span class="separator"></span>{!! $saleVilla->length !!} SQ FT</li> </ul>
	<p class="f18 lh18 mrg-bottom-auto pw100 cf-group">
	<span class="white">AED {!! number_format($saleVilla->Price, 3, ',', ','); !!} </span>
	</p>
	</div>
	</a>
	</article>
	</div>
	@elseif($loop->index < 6)
	<div class="column-33 property d-none villastwo">
	<article id="property_10411" class="list-item no-brd mrg-auto img-override">
	<a href="{{ url('details/'.$saleVilla->id ) }}" class="cf-group">
	<div class="no-brd">
	<img src="{!! config('urls.web_cdn_url') . 'assets/allimages' !!}/{!! $saleVilla->picture  !!}" class="full-width-responsive brd" loading="lazy" width="375" height="282">
	<span class="override animated text-left pdg-20">
	<h2 class="white normalcase mrg-top-auto">Brand New</h2>
	<p class="white f16 lh20">{!! $saleVilla->Description !!}</p>
	<p class="f16 lh20 white mrg-top-10">Learn more ›</p>
	</span>
	</div>
	<div class="pdg-top-10 pdg-bottom-10">
	<p class="f18 lh18 uppercase white ellipsis mrg-bottom-10">{!! substr($saleVilla->productname, 0, 25) !!}</p>
	<p class="f14 lh14 ellipsis mrg-bottom-5">
	{!! $saleVilla->Area !!}</p>
	<ul class="f14 lh14 ellipsis features ellipsis mrg-bottom-10">
	<li class="feature left">{!! $saleVilla->propertyType->title !!}</li>
	<li class="feature left"><span class="separator"></span>{!! $saleVilla->Bedrooms !!} BD</li><li class="feature left"><span class="separator"></span>{!! $saleVilla->length !!} SQ FT</li> </ul>
	<p class="f18 lh18 mrg-bottom-auto pw100 cf-group">
	<span class="white">AED {!! number_format($saleVilla->Price, 3, ',', ','); !!}</span>
	</p>
	</div>
	</a>
	</article>
	</div>
	@else
	<div class="column-33 property d-none villasthree">
	<article id="property_10411" class="list-item no-brd mrg-auto img-override">
	<a href="{{ url('details/'.$saleVilla->id ) }}" class="cf-group">
	<div class="no-brd">
	<img src="{!! config('urls.web_cdn_url') . 'assets/allimages' !!}/{!! $saleVilla->picture  !!}" class="full-width-responsive brd" loading="lazy" width="375" height="282">
	<span class="override animated text-left pdg-20">
	<h2 class="white normalcase mrg-top-auto">Brand New</h2>
	<p class="white f16 lh20 text-truncate">{!! $saleVilla->Description !!}</p>
	<p class="f16 lh20 white mrg-top-10">Learn more ›</p>
	</span>
	</div>
	<div class="pdg-top-10 pdg-bottom-10">
	<p class="f18 lh18 uppercase white ellipsis mrg-bottom-10">{!! substr($saleVilla->productname, 0, 25) !!}</p>
	<p class="f14 lh14 ellipsis mrg-bottom-5">
	{!! $saleVilla->Area !!}</p>
	<ul class="f14 lh14 ellipsis features ellipsis mrg-bottom-10">
	<li class="feature left">{!! $saleVilla->propertyType->title !!}</li>
	<li class="feature left"><span class="separator"></span>{!! $saleVilla->Bedrooms !!} BD</li><li class="feature left"><span class="separator"></span>{!! $saleVilla->length !!} SQ FT</li> </ul>
	<p class="f18 lh18 mrg-bottom-auto pw100 cf-group">
	<span class="white">AED {!! number_format($saleVilla->Price, 3, ',', ','); !!}</span>
	</p>
	</div>
	</a>
	</article>
	</div>
	@endif
    
	@endforeach
	
	</div>
	</div>
	</div>
	<div class="tab">
	<div class="mobile-slider">
	<div class="list inner">
	
	</div>
	</div>
	</div>
	</div>
	<div class="brd-bottom mrg-top-10"></div>
	</div>
	</section>
	<section id="listings" class="wrapper">
	<div class="home-section cf-group mrg-bottom-60">
	<header class="home-section-header cf-group">
	    @foreach($typetwo as $saleApartment)
	<h2 class="title mrg-top-auto" style="white-space: nowrap;">{!! App\Models\PropertyType::getpropertytypeviaid($saleApartment->property_type_id) !!}</h2>
	@break;
		@endforeach
	<span class="btn-group cf-group selector">
	<a id="appartmentone"  class="btn compact  tab-trigger">New To Market</a>
	<a  id="appartmenttwo"  class="btn compact tab-trigger">Price Reduction</a>
	<a  id="appartmentthree"  class="btn compact  tab-trigger">Featured</a>
	</span>
	</header>
	<div class="cf-group relative">
	<div class="tab active">
	<div class="mobile-slider">
	<div class="list inner">
	    
		@foreach($typetwo as $saleApartment)  
		@if($loop->index < 3) 
		<div class="column-33 property appartmentone">
			<article id="property_10407" class="list-item no-brd mrg-auto img-override">
				<a href="{{ url('details/'.$saleApartment->id ) }}" class="cf-group">
					<div class="no-brd">
						<img src="{!! config('urls.web_cdn_url') . 'assets/allimages' !!}/{!! $saleApartment->picture  !!}" loading="lazy" width="375" height="282">
						<span class="override animated text-left pdg-20">
							<h2 class="white normalcase mrg-top-auto">Dramatically Impressive, Luxury Apartment in Downtown Dubai</h2>
							<p class="white f16 lh20 text-truncate">{!! $saleApartment->Description !!}</p>
							<p class="f16 lh20 white mrg-top-10">Learn more ›</p>
						</span>
					</div>
					<div class="pdg-top-10 pdg-bottom-10">
						<p class="f18 lh18 uppercase white ellipsis mrg-bottom-10">{!! substr($saleApartment->productname, 0, 25) !!}</p>
						<p class="f14 lh14 ellipsis mrg-bottom-5">
							{!! $saleApartment->Area !!}</p>
							<ul class="f14 lh14 ellipsis features ellipsis mrg-bottom-10">
								<li class="feature left">{!! $saleApartment->propertyType->title !!}</li>
								<li class="feature left"><span class="separator"></span>{!! $saleApartment->Bedrooms !!} BD</li><li class="feature left"><span class="separator"></span>{!! $saleApartment->length !!} SQ FT</li> </ul>
								<p class="f18 lh18 mrg-bottom-auto pw100 cf-group">
									<span class="white">AED  {!! number_format($saleApartment->Price, 3, ',', ',');!!}</span>
								</p>
							</div>
						</a>
					</article>
				</div>

				@elseif($loop->index < 6)
				<div class="column-33 property d-none  appartmenttwo">
					<article id="property_10407" class="list-item no-brd mrg-auto img-override">
						<a href="{{ url('details/'.$saleApartment->id ) }}" class="cf-group">
							<div class="no-brd">
								<img src="{!! config('urls.web_cdn_url') . 'assets/allimages' !!}/{!! $saleApartment->picture  !!}" loading="lazy" width="375" height="282">
								<span class="override animated text-left pdg-20">
									<h2 class="white normalcase mrg-top-auto">Dramatically Impressive, Luxury Apartment in Downtown Dubai</h2>
									<p class="white f16 lh20 text-truncate">{!! $saleApartment->Description !!}</p>
									<p class="f16 lh20 white mrg-top-10">Learn more ›</p>
								</span>
							</div>
							<div class="pdg-top-10 pdg-bottom-10">
								<p class="f18 lh18 uppercase white ellipsis mrg-bottom-10">{!! substr($saleApartment->productname, 0, 25) !!}</p>
								<p class="f14 lh14 ellipsis mrg-bottom-5">
									{!! $saleApartment->Area !!}</p>
									<ul class="f14 lh14 ellipsis features ellipsis mrg-bottom-10">
										<li class="feature left">{!! $saleApartment->propertyType->title !!}</li>
										<li class="feature left"><span class="separator"></span>{!! $saleApartment->Bedrooms !!} BD</li><li class="feature left"><span class="separator"></span>{!! $saleApartment->length !!} SQ FT</li> </ul>
										<p class="f18 lh18 mrg-bottom-auto pw100 cf-group">
											<span class="white">AED {!! $saleApartment->Price !!}</span>
										</p>
									</div>
								</a>
							</article>
						</div>

						@else
						<div class="column-33 property d-none appartmentthree ">
							<article id="property_10407" class="list-item no-brd mrg-auto img-override">
								<a href="{{ url('details/'.$saleApartment->id ) }}" class="cf-group">
									<div class="no-brd">
										<img src="{!! config('urls.web_cdn_url') . 'assets/allimages' !!}/{!! $saleApartment->picture  !!}" loading="lazy" width="375" height="282">
										<span class="override animated text-left pdg-20">
											<h2 class="white normalcase mrg-top-auto">Dramatically Impressive, Luxury Apartment in Downtown Dubai</h2>
											<p class="white f16 lh20 text-truncate">{!! $saleApartment->Description !!}</p>
											<p class="f16 lh20 white mrg-top-10">Learn more ›</p>
										</span>
									</div>
									<div class="pdg-top-10 pdg-bottom-10">
										<p class="f18 lh18 uppercase white ellipsis mrg-bottom-10">{!! substr($saleApartment->productname, 0, 25) !!}</p>
										<p class="f14 lh14 ellipsis mrg-bottom-5">
											{!! $saleApartment->Area !!}</p>
											<ul class="f14 lh14 ellipsis features ellipsis mrg-bottom-10">
												<li class="feature left">{!! $saleApartment->propertyType->title !!}</li>
												<li class="feature left"><span class="separator"></span>{!! $saleApartment->Bedrooms !!} BD</li><li class="feature left"><span class="separator"></span>{!! $saleApartment->length !!} SQ FT</li> </ul>
												<p class="f18 lh18 mrg-bottom-auto pw100 cf-group">
													<span class="white">AED {!! $saleApartment->Price !!}</span>
												</p>
											</div>
										</a>
									</article>
								</div>
								@endif
								@endforeach
	
	
	

	</div>
	</div>
	</div>
	</div>
	<div class="brd-bottom mrg-top-10"></div>
	</div>
	</section>
	<section id="developments" class="wrapper">
	<div class="home-section cf-group mrg-bottom-60">
	<header class="home-section-header cf-group">
	    @foreach($typethree as $salepenthouses)
	<h2 class="title mrg-top-auto">Featured {!! App\Models\PropertyType::getpropertytypeviaid($salepenthouses->property_type_id) !!}</h2>
	@break;
		@endforeach
	</header>
	<div class="cf-group">
	<div class="mobile-slider">
	<div class="list inner">
	    
	    @foreach($typethree as $salepenthouses)
	<div class="column-33 property">
	<article id="development_1044" class="list-item no-brd mrg-auto">
	<a href="{{ url('details/'.$salepenthouses->id ) }}" class="cf-group">
	<div class="image aspect16-9 img-override no-brd">
	<img style="max-height:225px;" src="{{ asset('assets/allimages/'.$salepenthouses->picture) }}" alt="Atlantis The Royal Residences" class="left brd full-width-responsive" loading="lazy" width="375" height="211">
	<span class="override animated text-left pdg-20">
	<h2 class="white normalcase mrg-top-auto">{!! substr($salepenthouses->productname, 0, 25) !!}</h2>
		<p class="white f16 lh20 text-truncate">{!! $salepenthouses->Description !!}</p>
	</span>
	</div>
	<div class="pdg-top-10 pdg-bottom-20">
	<p class="f18 lh18 tw uppercase white ellipsis mrg-bottom-5">{!! substr($salepenthouses->productname, 0, 25) !!}</p>
	<p class="mrg-bottom-auto pw100 cf-group">
	<span class="f16 lh16">{!! $salepenthouses->Area !!}</span>
	</p>
	</div>
	</a>
	</article>
	</div>
	@endforeach
	
	
	
	</div>
	</div>
	</div>
	<div class="brd-bottom"></div>
	</div>
	</section>
	<section id="team" class="wrapper">
	<div class="home-section mrg-bottom-60">
	<div class="cf-group">
	<div class="column-66 left pdg-right-20">
	<header class="home-section-header cf-group">
	<h2 class="title mrg-top-auto">The Experts</h2>
	</header>
	<div class="">
	<div class="f16 lh24">Our Luxury Sales Specialists will offer you the best of services and expertise to keep in mind before buying or selling your property. Each of them specialise in at least one area in Dubai and know it from a hyperlocal level. Their networking and negotiating skills will ensure that you get the results you want - whether it's a sound property investment, purchasing a property or getting the right price for your property.</div>
	<a  href="agents" style="border: 1px solid white; border-radius: 5px; color: BLACK; background:white;" class="btn btn-sm my-3">FIND AN AGENT</a>
	</div>
	</div>
	<div class="column-33 right pdg-left-20">
	<img  src="assets/homeimages/expert.jpg" class="full-width-responsive brd" loading="lazy" alt="An agent working at Luxhabitat's office" width="480" height="320">
	</div>
	</div>
	<div class="brd-bottom mrg-top-20"></div>
	</div>
	</section><section id="the-journal" class="wrapper">
	<div class="home-section cf-group mrg-bottom-60">
	<header class="home-section-header cf-group">
	<div class="cf-group">
	<h2 class="title mrg-top-auto">The Journal</h2>
	</div>
	<p>The online journal of luxury homes, design, interiors, art and style</p>
	</header>
	<div class="mobile-slider">
	<div class="list inner">
	 
	@foreach($Journals as $Journal)    
	<div class="column-33 article">
	<article id="article_936" class="list-item no-brd mrg-auto">
	<a href="{!! url('Journal/'.$Journal->id ) !!}" title="Read article">
	<img style="max-height:225px;" src="{!! config('urls.web_cdn_url') . 'assets/allimages' !!}/{!! $Journal->picture !!}" alt="The Menu: Breaking bread with Solemann Haddad" class="full-width-responsive" loading="lazy" width="377" height="227">
	<div class="text-left">
	<p class="f14 mrg-top-20">{!! $Journal->Publish_date !!}</p>
	<h2 class="tw light-silver hover uppercase mrg-top-5 mrg-bottom-20 title-eq tablet-text-left">{!! $Journal->journal_title !!}</h2>
	<p class="f16 lh20 mrg-bottom-30 text-left" style="white-space: normal;overflow: hidden;text-overflow: unset;height: 60px;line-height: 20px;">{!! substr($Journal->description,0,300) !!}</p>
	</div>
	</a>
	</article>
	</div>
	@endforeach
	

	

	
	
	</div>
	</div>
	<div class="mrg-left-20 mrg-ignore-tablet">
	<a href="{!! url('/Journal') !!}" class="btn btn-white">View all articles</a>
	</div>
	</div>
	</section>
	</main>




@include('includes.footer')
</div>
</section>

<script type="text/javascript">
	$( document ).ready(function() {
		$( "#vilaone" ).click(function() {
			$(".villasone").removeClass("d-none")
			$(".villastwo").addClass("d-none");
			$(".villasthree").addClass("d-none");
		});
		$( "#vilatwo" ).click(function() {
			$(".villasone").addClass("d-none");
			$(".villastwo").removeClass("d-none");
			$(".villasthree").addClass("d-none");
		});
		$( "#vilathree" ).click(function() {
			$(".villasone").addClass("d-none");
			$(".villastwo").addClass("d-none");
			$(".villasthree").removeClass("d-none");
		});


		$( "#appartmentone" ).click(function() {
			$(".appartmentone").removeClass("d-none")
			$(".appartmenttwo").addClass("d-none");
			$(".appartmentthree").addClass("d-none");
		});
		$( "#appartmenttwo" ).click(function() {
			$(".appartmentone").addClass("d-none");
			$(".appartmenttwo").removeClass("d-none");
			$(".appartmentthree").addClass("d-none");
		});
		$( "#appartmentthree" ).click(function() {
			$(".appartmentone").addClass("d-none");
			$(".appartmenttwo").addClass("d-none");
			$(".appartmentthree").removeClass("d-none");
		});


	


 $( ".Category" ).click(function() {
       	    var Category = $(this).val();
			var typeid = $('.defaultproperty').val();
			var propertyName= $(this).attr('data-property-name');
            var minsize = $('.minvalue').children("option:selected").val();
			var maxsize= $('.maxvalue').children("option:selected").val();
			var bedrooms = $('.defaultBedrooms').val();
			var minprice = $('.minprice').children("option:selected").val();
			var maxprice= $('.maxprice').children("option:selected").val();
			var pathname = window.location.href;
		
			var  redirecturl = pathname  +  'filters' + '?' + 'Category=' +  Category + '&' + 'propertytypeid=' +  typeid + '&' + 'minsize=' +  minsize + '&' +  'maxsize=' +  maxsize + '&' +  'Bedrooms=' +  bedrooms +  '&'  +  'minprice=' +  minprice + '&' +  'maxprice=' +  maxprice ;
			window.location.href = redirecturl;
		});


       $( ".typename" ).click(function() {
			var typeid = $(this).val();
			var propertyName= $(this).attr('data-property-name');
			var Category= $('.defaultcategory').val();
            var minsize = $('.minvalue').children("option:selected").val();
			var maxsize= $('.maxvalue').children("option:selected").val();
			var bedrooms = $('.defaultBedrooms').val();
			var minprice = $('.minprice').children("option:selected").val();
			var maxprice= $('.maxprice').children("option:selected").val();
				var pathname = window.location.href;
			var  redirecturl = pathname  +  'filters' + '?' + 'Category=' +  Category + '&' + 'propertytypeid=' +  typeid + '&' + 'minsize=' +  minsize + '&' +  'maxsize=' +  maxsize + '&' +  'Bedrooms=' +  bedrooms +  '&'  +  'minprice=' +  minprice + '&' +  'maxprice=' +  maxprice ;
			window.location.href = redirecturl;
		});

      



		$('.maxvalue').on('change', function() {
			var Category= $('.defaultcategory').val();
			var typeid = $('.defaultproperty').val();
			var propertyName= $(this).attr('data-property-name');
            var minsize = $('.secondindex').val();
			var maxsize= $('.maxvalue').children("option:selected").val();
			var bedrooms = $('.defaultBedrooms').val();
			var minprice = $('.minprice').children("option:selected").val();
			var maxprice= $('.maxprice').children("option:selected").val();
				var pathname = window.location.href;
			var  redirecturl = pathname   +  'filters' + '?'+ 'Category=' +  Category + '&'  + 'propertytypeid=' +  typeid + '&' + 'minsize=' +  minsize + '&' +  'maxsize=' +  maxsize + '&' +  'Bedrooms=' +  bedrooms +  '&'  +  'minprice=' +  minprice + '&' +  'maxprice=' +  maxprice ;
			window.location.href = redirecturl;
           });

		  $( ".Bedrooms" ).click(function() {
		  	var Category= $('.defaultcategory').val();
			var typeid = $('.defaultproperty').val();
			var propertyName= $(this).attr('data-property-name');
            var minsize = $('.minvalue').children("option:selected").val();
			var maxsize= $('.maxvalue').children("option:selected").val();
			var bedrooms = $(this).val();
			var minprice = $('.minprice').children("option:selected").val();
			var maxprice= $('.maxprice').children("option:selected").val();
				var pathname = window.location.href;
			var  redirecturl = pathname  +  'filters' + '?' + 'Category=' +  Category + '&' + 'propertytypeid=' +  typeid + '&' + 'minsize=' +  minsize + '&' +  'maxsize=' +  maxsize + '&' +  'Bedrooms=' +  bedrooms +  '&'  +  'minprice=' +  minprice + '&' +  'maxprice=' +  maxprice ;
			window.location.href = redirecturl;
		});


       	$('.maxprice').on('change', function() {
       		var Category= $('.defaultcategory').val();
			var typeid = $('.defaultproperty').val();
			var propertyName= $(this).attr('data-property-name');
            var minsize = $('.minvalue').children("option:selected").val();
			var maxsize= $('.maxvalue').children("option:selected").val();
			var bedrooms = $('.defaultBedrooms').val();
			var minprice = $('.index').val();
			var maxprice= $('.maxprice').children("option:selected").val();
				var pathname = window.location.href;
			var  redirecturl = pathname  +  'filters' + '?' + 'Category=' +  Category + '&' + 'propertytypeid=' +  typeid + '&' + 'minsize=' +  minsize + '&' +  'maxsize=' +  maxsize + '&' +  'Bedrooms=' +  bedrooms +  '&'  +  'minprice=' +  minprice + '&' +  'maxprice=' +  maxprice ;
			window.location.href = redirecturl;
		});
			});
</script>



@endsection