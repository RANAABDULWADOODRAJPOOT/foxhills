@extends('lux_habitate')
@section('content')
@if( ! Agent::isMobile())
@include('partials.homeScreenFilter')
@endif





		<main id="content" class="pw100" style="display:table;">
			{{-- <ol id="breadcrumbs" class="row-li">
			<li>
			<a href="/">Home</a>
			</li>
			<li>
			<a href="/">{!! $userProducts->city !!}</a>
			</li>
			<li>
			<a href="">{!! $userProducts->productname !!}</a>
			</li>
			
			</ol> --}}
			<div class="wrapper p-2">
			<article id="property-10382">
			<header class="brd-bottom">
			<h1 id="property-title" class="tw mrg-bottom-20">{!! $userProducts->productname !!}</h1>
			</header>
			<div id="property-media" class="column-66 left relative mrg-bottom-20 multiple js-more-images mb-slider">
             @if(!$images->isEmpty())
				<div id="demo" class="carousel slide mb-slider" data-ride="carousel">
					  <!-- Indicators -->
				<ul class="carousel-indicators">
					@foreach($images as $imageindex)
					<li data-target="#demo" data-slide-to="{{$loop->index}}" class="active"></li>
					@endforeach
					
				</ul>
					<div class="carousel-inner">
						@foreach($images as $imageindex)
						@if($loop->index == 0 )
						<div class="carousel-item active">
							<img src="<?php echo asset("assets/allimages/$imageindex->picture")?>" alt="Brand New Designer Villa on Palm Jumeirah image 1" class="full-width-responsive mb-slider md-slider" width="786" height="591" style="max-width:786px;max-height:591px">
						</div>
						@else
						<div class="carousel-item">
							<img src="<?php echo asset("assets/allimages/$imageindex->picture")?>" alt="Brand New Designer Villa on Palm Jumeirah image 1" class="full-width-responsive mb-slider md-slider" width="786" height="591" style="max-width:786px;max-height:591px">
						</div>
						@endif
						@endforeach
					</div>
					  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
				</div>
				@else
				<picture class="pw100">
					<source media="(max-width: 480px)" srcset="https://do84cgvgcm805.cloudfront.net/10382/375/264e221b237c66c3dc79d289152cac3a30bf64128a287011c4f77a0c8abde56b.jpg 1x, https://do84cgvgcm805.cloudfront.net/10382/786/264e221b237c66c3dc79d289152cac3a30bf64128a287011c4f77a0c8abde56b.jpg 2x">
						<img src="<?php echo asset("assets/allimages/$userProducts->picture")?>" alt="Brand New Designer Villa on Palm Jumeirah image 1" class="full-width-responsive" width="786" height="591">
					</picture>
			@endif




			<div class="more-pictures ">
			
			</div>
			{{-- <a class="heart-button right hover login-button " data-id="10382" title="Add to collection">
			<svg fill="#000000" height="36" viewBox="0 0 24 24" width="36" xmlns="http://www.w3.org/2000/svg">
			<path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
			</svg>
			</a> --}}
			</div>





			<div id="property-details" class="column-33 right pdg-left-20 ">
			<div class="cf-group pdg-left-20 pdg-right-20 pdg-ignore-tablet">
			<div class="pdg-top-20 pdg-bottom-20">
			<div class="mrg-bottom-5">
			<span class="f16 lh20 uppercase silver">{!! App\Models\AvailableProperty::getPropertyType($userProducts->Category) !!}</span>
			</div>
			<h2 class="f20 lh24 text-left white mrg-top-10 mrg-bottom-auto" style="text-transform: inherit;">{!! $userProducts->productname !!}</h2>
			<div class="f20 lh24 uppercase white mt-3">AED {!! number_format($userProducts->Price, 0, ',', ','); !!}</div>
			</div>
			<div class="pdg-bottom-10">
			<div class="silver f14">
			<a href="/" title="View editor's picks">Editor's pick</a>
			</div>
			</div>
			</div>
			<div class="mrg-top-10 mrg-bottom-20 pw100 mb-center">
			<a  class="btn btn-white open-enquiry request">request information</a>
			</div>
			<div class="cf-group mrg-bottom-20 brd-top">
			<header>
			<h2 class="f16 lh24 white uppercase pdg-left-20 pdg-ignore-tablet">location</h2>
			</header>
			<table class="property-details-table silver pw100" style="table-layout: fixed;">
			<tbody><tr>
			<td>City</td>
			<td class="light-silver">
			<span>{!! $userProducts->city !!} </span>
			</td>
			</tr>
			<tr>
			<td>Area</td>
			<td class="light-silver">
			<span>
			<a href="/" class="underline">{!! $userProducts->Area !!}</a>
			</span>
			</td>
			</tr>
			<tr>
			<td>Development</td>
			<td class="light-silver">
			<a href="/" class="underline">{!! $userProducts->Speciality !!}</a>
			</td>
			</tr>
			
			</tbody></table>
			</div>









			<div class="cf-group mrg-bottom-20 brd-top mrg-top-10">
			<header>
			<h2 class="f16 lh24 white uppercase pdg-left-20 pdg-ignore-tablet">Essentials</h2>
			</header>
			<table class="property-details-table silver pw100">
			<tbody>
			<tr>
			<td>Type</td>
			<td class="light-silver">
			<a href="/" class="underline hover">{!! App\Models\AvailableProperty::getPropertyType($userProducts->Category) !!}</a>
			</td>
			</tr>
			<tr>
			<td>Availability</td>
			<td class="light-silver">Ready</td>
			</tr>
			<tr>
			<td>Bedrooms</td>
	
				<td class="light-silver">{!! $userProducts->Bedrooms !!}</td>
		
			</tr>
			<tr>
			<td>Bathrooms</td>
			<td class="light-silver">{!! $userProducts->bathrooms !!}</td>
			</tr>
			<tr>
			<td>Speciality</td>
			<td class="light-silver">{!! $userProducts->Speciality !!}</td>
			</tr>
			<tr>
			<td>Plot size</td>
			<td class="light-silver">{!! $userProducts->length !!} sq ft</td>
			</tr>
			</tbody></table>
			</div>
			</div>
			<div id="description-and-features" class="column-66 left">
			<div class="pw100 cf-group pdg-20 mobile brd-top">
			<div class="pw50 pdg-right-10 left">
			<a class="btn btn-white pw100" href="tel:+9745896777">Call</a>
			</div>
			<div class="pw50 left">
			<a class="btn btn-white pw100 open-enquiry" href="mailto:info@foxhills.ae">E-mail</a>
			</div>
			</div>

			<div id="property-descriptionone" class="pdg-left-20 pdg-right-10 pdg-ignore-tablet cf-group">
			<h2 class="f16 lh24 white uppercase">About this property</h2>
			<div class="f14 lh22 collapsed-text brd-ignore-mobile pdg-right-10">
			<p id="half">{!! Str::limit($userProducts->Description,250) !!}</p> </div>
			<a   class="pw100 left collapsed-text-trigger text-center tw white uppercase pdg-10 f16 viewcontrol">Read more</a>
			</div>

			<div id="property-descriptiontwo" class="pdg-left-20 pdg-right-10 pdg-ignore-tablet cf-group d-none">
			<h2 class="f16 lh24 white uppercase">About this property</h2>
			<div class="f14 lh22  brd-ignore-mobile pdg-right-10">
		    <p id="full">{!! $userProducts->Description !!}</p> </div>
			<a   class="pw100 left collapsed-text-trigger text-center tw white uppercase pdg-10 f16 viewcontrol">Read less</a>
			</div>

			<div id="property-features" class="pw100 cf-group brd-top mrg-top-10 mrg-bottom-20">
			<h2 class="f16 lh24 white uppercase pdg-left-20 pdg-ignore-tablet">Features</h2>
			<table class="property-details-table silver pw100">
			<tbody><tr>
			<td width="120">Permit</td>
			<td class="light-silver">{!! $userProducts->id !!}</td>
			</tr>
			
			<tr>
			<td>Views</td>
			<td class="light-silver">{!! $userProducts->Area !!}</td>
			</tr>
			<tr>
			<td>Amenities</td>
			<td class="light-silver">
			{!! Str::limit($userProducts->Description,100) !!}</td>
			</tr>
			</tbody></table>
			</div>
			</div>
			<div id="agent" class="column-33 right">
			<div class="cf-group mrg-left-20 mrg-ignore-mobile brd-top mrg-top-10">
			<header>
			<h2 class="f16 lh24 white uppercase pdg-left-20 pdg-ignore-tablet">Property representative</h2>
			</header>


           

           @php ($agentdata = App\Models\agent::getagentdata($userProducts->agent))
            @if(!empty($agentdata))
			<table class="property-details-table silver pw100 f14 lh14 pdg-left-10 pdg-right-10 pdg-ignore-tablet">
			<tbody>
			<tr>
			<td width="115" rowspan="3" class="brd-ignore-mobile">
			<div class="pdg-right-20">
				<img class="full-width-responsive" src="<?php echo asset("assets/allimages/$agentdata->picture")?>"  width="90" height="90">
			</div>
			</td>
			<td class="brd-ignore-mobile">
			<p class="white mrg-bottom-5">{!! $agentdata->agentname !!}</p>
			<p class="mrg-bottom-5">{!! $agentdata->Desigination !!}</p>
			<p class="mrg-bottom-5">{!! $agentdata->Licence !!}</p>
			</td>
			</tr>
			</tbody>
			</table>
			@endif


			<div class="pdg-right-10 mrg-top-10 mrg-bottom-10 tablet left pw100">
			<a class="btn btn-white open-enquiry request" style="width:198px;">Contact agent</a>
			</div>
			</div>
			</div>
			<style>.map-wrapper{width:100%; height:320px;}
					@media screen and (min-width: 768px){
						#map{display:flex; align-items:stretch;}
						.map-wrapper{height:100%;}
					}
					</style>
			<aside id="map" class="pw100 cf-group left brd mrg-bottom-20 mrg-ignore-mobile light-bg">
			<div class="column-66 left pdg-30">
			<article>
			<header>
			<h2 class="white uppercase mrg-top-auto"></h2>
			</header>
			<h3 class="silver mrg-top-auto">
			 <span class="white">{!! $userProducts->productname !!}</span> </h3>
			<p class="f16 lh20 text-justify mrg-bottom-10">{!! Str::limit($userProducts->Description,200) !!}</p>
			<p class="f16 lh20 mrg-bottom-30">
			
			</p>
			<article>
			<header>
			<h3 class="silver mrg-top-auto">
			Located in <span class="white">{!! $userProducts->Area !!}</span> </h3>
			</header>
			
			
			</p>
			</article>
			</article>
			</div>
			<div class="column-33 right brd-left brd-ignore-mobile">
			
			 <iframe width="100%" height="300" src="https://maps.google.com/maps?q=<?php echo $userProducts->lat ?>,<?php echo $userProducts->lon; ?>&output=embed"></iframe>
			</div>
			</aside>
			</article>
			<section id="related-properties" class="cf-group left pw100 mrg-bottom-30">
			<header class="pw100 cf-group">
			<h2 class="f16 lh24 white uppercase pdg-left-20 pdg-ignore-tablet mrg-top-30 mrg-bottom-20">You might be interested in these properties</h2>
			</header>
			<div class="properties-content">
			<div class="mobile-slider">
			<div class="list inner">

            @if(!empty($alluserProducts))
            @foreach($alluserProducts as $data)
			<div class="column-33 property">
			<article id="property_10254" class="list-item no-brd mrg-auto img-override">
			<a href="{{ url('details/'.$data->id ) }}" class="cf-group">
			<div>
			<img style="height: 250px;" class=" img-fluid w-100" src="{!! config('urls.web_cdn_url') . '/assets/allimages' !!}/{!! $data->picture  !!}">
			<span class="override animated text-left pdg-20">
				
			<h2 class="white normalcase mrg-top-auto text-truncate">{!! $data->Description  !!}.</p>
			<p class="f16 lh20 white mrg-top-10">Click to view more details ›</p>
			</span>
			</div>
			<div class="pdg-top-10 pdg-bottom-10">
			<p class="f18 lh18 uppercase white ellipsis mrg-bottom-10">{!! $data->productname !!}</p>
			<p class="f14 lh14 ellipsis mrg-bottom-5">
			{!! $data->Area !!}</p>
			<ul class="f14 lh14 ellipsis features ellipsis mrg-bottom-10">
				@php ($title = App\Models\AvailableProperty::getpropertytypeinfo($data->property_type_id))
			<li class="feature left">{!!  $title  !!}</li>
			<li class="feature left"><span class="separator"></span>{!! $data->Bedrooms  !!} BD</li><li class="feature left"><span class="separator"></span>{!! $data->length  !!} SQ FT</li> </ul>
			<p class="f18 lh18 mrg-bottom-auto pw100 cf-group">
			<span class="white">AED {!! number_format($data->Price, 0, ',', ','); !!}</span>
			</p>
			</div>
			</a>
			</article>
			</div>
			@endforeach
           @endif
</div>
			</div>
			</div>
			</section>
			</div>
			
			
			<div  class="modal myModalAll" tabindex="-1" role="dialog">
					<div class="col-md-6 offset-md-3 col-12 mt-5" role="document">
						<div style="background-color: black; border: 5px solid #222;" class="modal-content">
							<div class="modal-body p-4">
								<div class="col-12 m-0 p-0">
									<button type="button" data-dismiss="modal" aria-label="Close" style="position: relative;
									float: right;
									width: 35px;
									margin-top: 0px;
									border: 0px;">
									   <span aria-hidden="true">&times;</span>
								   </button>
									<h3 class="text-light">Enquiry About Listing {!! $userProducts->productname !!}</h3>
									<p class="text-grey d-md-block">Contact our Luxury Specialist on <a  style="color: #999; text-decoration: none; font-size: 14px;" href="tel:+971 48 89 67 77">+971 48 89 67 77</a> or kindly provide your details below</p>
									
								</div>

								<div class="row">
									<div class="col-md-6 col-12 mb-3">	

										<img src="<?php echo asset("assets/allimages/$userProducts->picture")?>" alt="Brand New Designer Villa on Palm Jumeirah image 1" class="full-width-responsive" width="120" height="120">
									</div>
									<div class="col-md-6 col-12">
										<form method="POST" action="{{url('sale/save-request-from-user')}}" enctype="multipart/form-data">
											@csrf
											<input  style="height: 40px;border: none; " class="form-group w-100 " type="text" name="name" placeholder="Full Name" required>
											<input  style="height: 40px;border: none; " class="form-group w-100 " type="email" name="email" placeholder="Email" required>
											<input  style="height: 40px;border: none; " class="form-group w-100 " type="tel" name="phone" placeholder="Phone Number" id="mobile-number" required>
											<textarea  style="border: none; " class="form-group w-100 " type="text" name="description" required>I'd like to have more information about the property ID #  {!! $data->id !!}</textarea>
                                            @if(str_contains( App\Models\AvailableProperty::getPropertyType($userProducts->Category) ,"Sale"))
                                           <input  style="height: 40px;border: none; " class="form-group w-100 " type="hidden" name="user_request_type" value="buy">
                                            @else
                                           <input  style="height: 40px;border: none; " class="form-group w-100 " type="hidden" name="user_request_type"  value="{!! App\Models\AvailableProperty::getPropertyType($userProducts->Category) !!}">
                                            @endif
											
											<div class="col-12 text-center m-0 p-0">
												<button style="background-color:white; border: 1px solid white;  color: black  ;" class="btn btn-md text-right mt-1 float-right">Submit Enquiry</button>
											</div>
										</form>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>

			<script type="text/javascript">
				  var count = 0; 
					$( ".request" ).click(function() {
						$(".myModalAll").modal("toggle")
					});

					$( ".viewcontrol" ).click(function() {

						if(count == 0){
						$("#property-descriptionone").addClass("d-none");
						$("#property-descriptiontwo").removeClass("d-none");
						count = 1; 
					}
					else{
                        $("#property-descriptionone").removeClass("d-none");
						$("#property-descriptiontwo").addClass("d-none");
						count = 0; 
					}

					});

					$( document ).ready(function() {
        

         $( ".Category" ).click(function() {
         	var parameterarray = getUrlVars();
         	var Category = $(this).val();
         	var typeid = parameterarray['propertytypeid'];
         	var minsize = parameterarray['minsize'];
         	var maxsize = parameterarray['maxsize'];
         	var bedrooms = parameterarray['Bedrooms'];
         	var minprice = parameterarray['minprice'];
         	var maxprice = parameterarray['maxprice'];
         	var pathname = window.location.origin
         	var  redirecturl = pathname + '/'  +  'filters' + '?' + 'Category=' +  Category + '&' + 'propertytypeid=' +  typeid + '&' + 'minsize=' +  minsize + '&' +  'maxsize=' +  maxsize + '&' +  'Bedrooms=' +  bedrooms +  '&'  +  'minprice=' +  minprice + '&' +  'maxprice=' +  maxprice ;
         	window.location.href = redirecturl;
		});


       $( ".typename" ).click(function() {
       	    var parameterarray = getUrlVars();
         	var Category = parameterarray['Category'];
         	var typeid = $(this).val();
         	var minsize = parameterarray['minsize'];
         	var maxsize = parameterarray['maxsize'];
         	var bedrooms = parameterarray['Bedrooms'];
         	var minprice = parameterarray['minprice'];
         	var maxprice = parameterarray['maxprice'];
      
			var pathname = window.location.origin
			var  redirecturl = pathname + '/'  +  'filters' + '?' + 'Category=' +  Category + '&' + 'propertytypeid=' +  typeid + '&' + 'minsize=' +  minsize + '&' +  'maxsize=' +  maxsize + '&' +  'Bedrooms=' +  bedrooms +  '&'  +  'minprice=' +  minprice + '&' +  'maxprice=' +  maxprice ;
         	window.location.href = redirecturl;
		});

      



		$('.maxvalue').on('change', function() {
			var parameterarray = getUrlVars();
         	var Category = parameterarray['Category'];
         	var typeid = parameterarray['propertytypeid'];
         	var minsize = parameterarray['minsize'];
         	var maxsize = $(this).val();
         	var bedrooms = parameterarray['Bedrooms'];
         	var minprice = parameterarray['minprice'];
         	var maxprice = parameterarray['maxprice'];
			var pathname = window.location.origin
			var  redirecturl = pathname  + '/'  +  'filters' + '?' + 'Category=' +  Category + '&' + 'propertytypeid=' +  typeid + '&' + 'minsize=' +  minsize + '&' +  'maxsize=' +  maxsize + '&' +  'Bedrooms=' +  bedrooms +  '&'  +  'minprice=' +  minprice + '&' +  'maxprice=' +  maxprice ;
         	window.location.href = redirecturl;
           });

		  $( ".Bedrooms" ).click(function() {
		  	var parameterarray = getUrlVars();
         	var Category = parameterarray['Category'];
         	var typeid = parameterarray['propertytypeid'];
         	var minsize = parameterarray['minsize'];
         	var maxsize = parameterarray['maxsize'];
         	var bedrooms = $(this).val();
         	var minprice = parameterarray['minprice'];
         	var maxprice = parameterarray['maxprice'];
			var pathname = window.location.origin
		    var  redirecturl = pathname  + '/'  +  'filters' + '?' + 'Category=' +  Category + '&' + 'propertytypeid=' +  typeid + '&' + 'minsize=' +  minsize + '&' +  'maxsize=' +  maxsize + '&' +  'Bedrooms=' +  bedrooms +  '&'  +  'minprice=' +  minprice + '&' +  'maxprice=' +  maxprice ;
         	window.location.href = redirecturl;
		});


       	$('.maxprice').on('change', function() {
       		var parameterarray = getUrlVars();
         	var Category = parameterarray['Category'];
         	var typeid = parameterarray['propertytypeid'];
         	var minsize = parameterarray['minsize'];
         	var maxsize = parameterarray['maxsize'];
         	var bedrooms = parameterarray['Bedrooms'];
         	var minprice = parameterarray['minprice'];
         	var maxprice = $(this).val();
			var pathname = window.location.origin
		    var  redirecturl = pathname  + '/'  +  'filters' + '?' + 'Category=' +  Category + '&' + 'propertytypeid=' +  typeid + '&' + 'minsize=' +  minsize + '&' +  'maxsize=' +  maxsize + '&' +  'Bedrooms=' +  bedrooms +  '&'  +  'minprice=' +  minprice + '&' +  'maxprice=' +  maxprice ;
         	window.location.href = redirecturl;
		});

		});



		function getUrlVars()
		{
			var vars = [], hash;
			var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
			for(var i = 0; i < hashes.length; i++)
			{
				hash = hashes[i].split('=');
				vars.push(hash[0]);
				vars[hash[0]] = hash[1];
			}
			return vars;
		}
			
			var sliderImages = [
					{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/264e221b237c66c3dc79d289152cac3a30bf64128a287011c4f77a0c8abde56b.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/264e221b237c66c3dc79d289152cac3a30bf64128a287011c4f77a0c8abde56b.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/264e221b237c66c3dc79d289152cac3a30bf64128a287011c4f77a0c8abde56b.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 1'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/b64a307249357209b90a251f915e776e5f4475bed35d7bce03e7d751012340cf.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/b64a307249357209b90a251f915e776e5f4475bed35d7bce03e7d751012340cf.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/b64a307249357209b90a251f915e776e5f4475bed35d7bce03e7d751012340cf.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 2'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/152126729749b0507c93ac12b686cbceee2de89f759055781bf675af746ec2ea.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/152126729749b0507c93ac12b686cbceee2de89f759055781bf675af746ec2ea.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/152126729749b0507c93ac12b686cbceee2de89f759055781bf675af746ec2ea.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 3'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/aff8a649bca2ac0cc499f07246a6ddb0e0565b5a3e282948677ae2905770467d.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/aff8a649bca2ac0cc499f07246a6ddb0e0565b5a3e282948677ae2905770467d.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/aff8a649bca2ac0cc499f07246a6ddb0e0565b5a3e282948677ae2905770467d.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 4'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/a2c620b94438ddb1a8a8767f239d8fcdef7595a416dd3f0e0322bc3abddd2f6e.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/a2c620b94438ddb1a8a8767f239d8fcdef7595a416dd3f0e0322bc3abddd2f6e.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/a2c620b94438ddb1a8a8767f239d8fcdef7595a416dd3f0e0322bc3abddd2f6e.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 5'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/be1247df1bfc7fae3f4819a13377f6f457b8b4c18c8aefe16974fc4776fdea2b.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/be1247df1bfc7fae3f4819a13377f6f457b8b4c18c8aefe16974fc4776fdea2b.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/be1247df1bfc7fae3f4819a13377f6f457b8b4c18c8aefe16974fc4776fdea2b.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 6'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/99c95d238dd8851fc355d94553a20a80c5a1089bbebf9ea2172b240d99a3de9e.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/99c95d238dd8851fc355d94553a20a80c5a1089bbebf9ea2172b240d99a3de9e.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/99c95d238dd8851fc355d94553a20a80c5a1089bbebf9ea2172b240d99a3de9e.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 7'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/e69acc56e19ba138c9449ea91e1bd7ede919d0820b2f76f39b1a3e0b99813a1a.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/e69acc56e19ba138c9449ea91e1bd7ede919d0820b2f76f39b1a3e0b99813a1a.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/e69acc56e19ba138c9449ea91e1bd7ede919d0820b2f76f39b1a3e0b99813a1a.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 8'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/930bb9a0a0a4298e47c5a68f318f094b1c437d87adf8188847442dfc29f29647.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/930bb9a0a0a4298e47c5a68f318f094b1c437d87adf8188847442dfc29f29647.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/930bb9a0a0a4298e47c5a68f318f094b1c437d87adf8188847442dfc29f29647.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 9'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/082d44eae5fe77195662ded8cefcdfef4e71d7324e9869c09896a3037aa5faf5.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/082d44eae5fe77195662ded8cefcdfef4e71d7324e9869c09896a3037aa5faf5.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/082d44eae5fe77195662ded8cefcdfef4e71d7324e9869c09896a3037aa5faf5.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 10'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/be631781a62241fc22361ede31c7c9b8bc19b10c604223195891f7d649eaaf9d.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/be631781a62241fc22361ede31c7c9b8bc19b10c604223195891f7d649eaaf9d.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/be631781a62241fc22361ede31c7c9b8bc19b10c604223195891f7d649eaaf9d.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 11'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/8c5767b8d598e8d0c0a1e389cd64efb9139a45af79e06a0175aad561dfdc03d0.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/8c5767b8d598e8d0c0a1e389cd64efb9139a45af79e06a0175aad561dfdc03d0.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/8c5767b8d598e8d0c0a1e389cd64efb9139a45af79e06a0175aad561dfdc03d0.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 12'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/d46ca85df14ea8c9a29a1cf8b8a5260ca4c945138e53ddda66ba2f8ce7995b2e.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/d46ca85df14ea8c9a29a1cf8b8a5260ca4c945138e53ddda66ba2f8ce7995b2e.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/d46ca85df14ea8c9a29a1cf8b8a5260ca4c945138e53ddda66ba2f8ce7995b2e.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 13'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/89db0d950706809ab749ad3ef1a22dafd2af1006d55c237245f3ca2368e2c51d.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/89db0d950706809ab749ad3ef1a22dafd2af1006d55c237245f3ca2368e2c51d.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/89db0d950706809ab749ad3ef1a22dafd2af1006d55c237245f3ca2368e2c51d.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 14'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/2e7e47209461b028cb638d29977db3b255d321007d29d3209d9ecb7d61ee8b3a.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/2e7e47209461b028cb638d29977db3b255d321007d29d3209d9ecb7d61ee8b3a.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/2e7e47209461b028cb638d29977db3b255d321007d29d3209d9ecb7d61ee8b3a.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 15'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/b42d718daef5f5ee09d6d0479373cac5dd2b00169213f35090e326fc588e36e8.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/b42d718daef5f5ee09d6d0479373cac5dd2b00169213f35090e326fc588e36e8.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/b42d718daef5f5ee09d6d0479373cac5dd2b00169213f35090e326fc588e36e8.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 16'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/f22f6e063d53624f05e4741c99975e37eda0b41bacd229a3f1c7448ff63caf0f.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/f22f6e063d53624f05e4741c99975e37eda0b41bacd229a3f1c7448ff63caf0f.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/f22f6e063d53624f05e4741c99975e37eda0b41bacd229a3f1c7448ff63caf0f.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 17'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/ec38d4036d1410ccb5ec98bc4647ba6d3f5c12585dbee0288140706f545d9de7.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/ec38d4036d1410ccb5ec98bc4647ba6d3f5c12585dbee0288140706f545d9de7.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/ec38d4036d1410ccb5ec98bc4647ba6d3f5c12585dbee0288140706f545d9de7.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 18'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/7da0bc9215e5b609cb3d912b89d6968f643d9301748e227e1765e294d131ed4a.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/7da0bc9215e5b609cb3d912b89d6968f643d9301748e227e1765e294d131ed4a.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/7da0bc9215e5b609cb3d912b89d6968f643d9301748e227e1765e294d131ed4a.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 19'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/106be66c151460f0ef56faf0898dda1c60dfa14f6654a5301286c60fe3672723.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/106be66c151460f0ef56faf0898dda1c60dfa14f6654a5301286c60fe3672723.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/106be66c151460f0ef56faf0898dda1c60dfa14f6654a5301286c60fe3672723.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 20'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/2e7ba31770854493f0830c37cfc865d6a5e5f8640f5a71ed77896f38a5488b60.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/2e7ba31770854493f0830c37cfc865d6a5e5f8640f5a71ed77896f38a5488b60.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/2e7ba31770854493f0830c37cfc865d6a5e5f8640f5a71ed77896f38a5488b60.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 21'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/37f9c0f512510d8c2cec2766b43bd0bf3e472ecd909324cc4ed1c581030f64eb.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/37f9c0f512510d8c2cec2766b43bd0bf3e472ecd909324cc4ed1c581030f64eb.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/37f9c0f512510d8c2cec2766b43bd0bf3e472ecd909324cc4ed1c581030f64eb.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 22'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/2a98055477979199c9830c447fb87bcef523c9cadacbc6fd92642b48499ba5c1.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/2a98055477979199c9830c447fb87bcef523c9cadacbc6fd92642b48499ba5c1.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/2a98055477979199c9830c447fb87bcef523c9cadacbc6fd92642b48499ba5c1.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 23'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/5e7e875a63dcb95a4d08d3ce13bc88d2989f007c464479ee5e38515c0bc34f10.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/5e7e875a63dcb95a4d08d3ce13bc88d2989f007c464479ee5e38515c0bc34f10.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/5e7e875a63dcb95a4d08d3ce13bc88d2989f007c464479ee5e38515c0bc34f10.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 24'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/6ae7fd38dfa7a23e8e8e95c957f6feed0b40c48f5aeb53dfbdef33c097137416.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/6ae7fd38dfa7a23e8e8e95c957f6feed0b40c48f5aeb53dfbdef33c097137416.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/6ae7fd38dfa7a23e8e8e95c957f6feed0b40c48f5aeb53dfbdef33c097137416.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 25'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/ec65519c5fc972369b4efe1ae60adb2b43e16cb2d714208da1192383cfe64f48.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/ec65519c5fc972369b4efe1ae60adb2b43e16cb2d714208da1192383cfe64f48.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/ec65519c5fc972369b4efe1ae60adb2b43e16cb2d714208da1192383cfe64f48.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 26'
				},
							{
					'small' : 'https://do84cgvgcm805.cloudfront.net/10382/375/3567013ce33e817745f034253ba68045ec65cfbda0f67be3eb900502fe4f7df0.jpg',
					'medium' : 'https://do84cgvgcm805.cloudfront.net/10382/786/3567013ce33e817745f034253ba68045ec65cfbda0f67be3eb900502fe4f7df0.jpg',
					'large' : 'https://do84cgvgcm805.cloudfront.net/10382/1920/3567013ce33e817745f034253ba68045ec65cfbda0f67be3eb900502fe4f7df0.jpg',
					'alt' : 'Brand New Designer Villa on Palm Jumeirah image 27'
				},
						];

             

			</script> </main>


				@include('includes.footer')

		@endsection