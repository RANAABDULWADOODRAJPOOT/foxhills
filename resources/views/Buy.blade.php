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
	<li>Dubai </li>
	</ol> --}}
	<div class="wrapper">
	<section id="filtered" class="cf-group">
	<header class="pw100 text-center cf-group">
	<h1 class="tw mrg-bottom-20 p-2"><?php echo $property->heading ?> LUXURY PROPERTIES IN DUBAI </h1>
	<div class="location-block collpase cf-group pw100 light-bg brd" data-name="Dubai ">
	<div class="column-66 pdg-20 text-left">
	<div class=" light-bg"><p>Dubai villas for sale provide villa owners the option of living in tranquil villa communities that are surrounded by lush greenery or the sea side. Most villa communities in Dubai are extremely family friendly and diverse; often with very close-knit communities in a gated environment that ensure safety and security. The many different styles of villa developments often include easy access to make daily life easier - from schools, strip malls to shopping centres, health facilities, gyms, and a variety of restaurants and cafés within a short distance.</p></div>
	<a  class="btn btn-white open-enquiry request">request information</a>

	</div>
	<div class="column-33 right pdg-10">
	<img src="https://do84cgvgcm805.cloudfront.net/region/1/375/ee4c705bfc2ecbd99750091bdc7bd28221bd8a41d2bb39fc8c82c04bbead6100.jpg" alt="Dubai, The City of the Future" width="375" height="211" class="full-width-responsive right brd">
	</div>
	</div>
	<nav class="pdg-top-10 pdg-bottom-10 pdg-right-15 pdg-left-15 mrg-bottom-20 mrg-ignore-mobile brd-ignore-mobile cf-group">
	
	</nav>
	<div class="mobile-slider shortcuts mrg-bottom-10 pdg-left-10 pdg-top-20 pdg-ignore-tablet brd-top brd-ignore-tablet text-left">
	
	<button class="shortcuts__trigger desktop">show more</button>
	</div>
	</header>
	<div class="filtered-content pw100">
	<div class="list flex">
	    
	 @foreach($alldatas as $alldata)
						@foreach($alldata->properties as $userproduct)   
	<div class="column-33 pdg-ignore-mobile">
	<article id="item_10410" class="list-item img-override">
	<a href="{{ url('details/'.$userproduct->id ) }}" class="cf-group">
	<div class="image no-brd">
	<picture class="pw100">
	<img src="<?php echo asset("assets/allimages/{$userproduct->picture}")?>" class="full-width-responsive" alt="Stunning Lake View Mansion Villa in Emirates Hills" width="375" height="282">
	</picture>
	<span class="override animated text-left pdg-20">
	<h3 class="white normalcase mrg-top-auto">{!! $userproduct->productname !!}</h3>
	<p class="white f16 lh20 text-truncate">{!! $userproduct->Description !!}</p>
	<p class="f16 lh20 white mrg-top-10">View details ›</p>
	</span>
	<span class="tag">exclusive</span>
	</div>
	<div class="pdg-10 relative brd-top">
	<p class="f18 lh18 uppercase white ellipsis mrg-bottom-10">{!! $userproduct->productname !!}</p>
	<p class="f14 lh14 ellipsis mrg-bottom-5">
	{!! $userproduct->Area !!} </p>
	<ul class="f14 lh14 ellipsis features ellipsis mrg-bottom-10">
	  @php ($title = App\Models\AvailableProperty::getpropertytypeinfo($userproduct->property_type_id))
	<li class="feature left">{!!  $title  !!}</li>
	<li class="feature left"><span class="separator"></span>{!! $userproduct->Bedrooms !!} bd</li><li class="feature left"><span class="separator"></span>{!! $userproduct->length !!} SQ FT</li> </ul>
	<p class="f18 lh18 mrg-bottom-auto pw100 cf-group">
	<span class="white">AED {!! number_format($userproduct->Price, 0, ',', ','); !!}</span>
	</p>
	</div>
	</a>
	<button class="heart-button heart-button--card hover login-button 
					" data-id="10410" title="Add to collection" style="background:none;border:none">
	<svg fill="#000000" height="36" viewBox="0 0 24 24" width="36" xmlns="http://www.w3.org/2000/svg">
	<path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
	</svg> </button>
	</article>
	</div>
	@endforeach
					  @endforeach
	
	
	
	
	 </div>
	 
	  @if(!empty($serproducts))
                <Span class="mt-5">
                	{!! $userproducts->links();  !!}
                </Span>
                @endif
	 
	 
	<div class="left pw100">
	
	</section>
	</div>
	<aside id="mp-content" class="brd-top dark-bg brd-bottom">
	<div class="wrapper cf-group">
	<div class="mrg-top-60 mrg-bottom-60 pdg-left-10 pdg-right-10 pdg-ignore-desktop f20 lh28">
	<div class="pw100 cf-group text-left">
	<div>
	<div class="f20 lh28 mrg-bottom-20"><div itemscope="true" itemtype="https://schema.org/FAQPage"><p><br></p>
		<div class="faq-item active" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h3 itemprop="name">What do you need to know about villas in Dubai?</h3>
			<div itemscope="true" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
				<div itemprop="text">
					<p>There are numerous non-freehold and freehold villas in Dubai that are available for local and expat ownership respectively. One needs to first understand what kind of villa community they wish to be part of first and whether they are looking to rent or own a villa. Most villa communities are gated communities with high security protocols to ensure safety and security of the neighbourhood and children. Most villas also come with a garden and pool, or both. There are some villas such as those on the Palm Jumeirah, that also offer private beach access. Dubai is home to a wide variety of villa communities that will cater to each and every lifestyle. For example, the Dubai Hills Estate and Jumeirah Golf Estates villas are excellent for those that enjoy a golf-lifestyle and close proximity to schools and healthcare facilities. While purchasing a villa, you have to take into consideration the service charges payable for the area every year and the potential maintenance costs, especially for a villa with a pool or garden. Almost all villa communities are also pet-friendly, with pet-friendly outlets around as well. Another thing you may want to consider is home and contents insurance. For those that potentially want to upgrade your villa, you will need to take permissions from the developer before carrying out the renovation project.</p></div></div></div><div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question"><h3 itemprop="name">How affordable is living in Dubai?</h3><div itemscope="true" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text"><p>Despite having a high standard of living, Dubai offers you the convenience and ease unlike any other top city in the world. The affordability of living in Dubai varies greatly in terms of lifestyle. That being said, there are a number of communities one can invest in depending on the budget set out.</p></div></div></div><div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question"><h3 itemprop="name">Can foreigners buy a villa in Dubai?</h3><div itemscope="true" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text"><p>Yes, foreigners/expats can buy, rent or sell a villa in any of Dubai's freehold communities ever since 2002. Depending on the income invested, foreigners/expats can also get a residence visa.</p>
				</div>
			</div>
		</div>
		<div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h3 itemprop="name">What are the top villa communities in Dubai?</h3><div itemscope="true" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text"><p>The top villa communities in Dubai are Dubai Hills Estate, Palm Jumeirah, Emirates Hills, Arabian Ranches, Al Barari, Jumeirah Golf Estates, Meadows and Jumeirah Islands.</p></div></div></div><div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question"><h3 itemprop="name">Which are the best areas for family living in Dubai?</h3><div itemscope="true" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text"><p>The best areas for family living would include Dubai Hills Estate, Palm Jumeirah, Arabian Ranches, Al Barari, Meadows and Jumeirah Islands. We have picked these areas due to the ample availability of schools, clinics/hospitals and easy availability for basic amenities. These areas also have several parks and walkways that are safe for children and are pet-friendly too.</p></div></div></div><div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question"><h3 itemprop="name">What are the top reasons to invest in Dubai?</h3><div itemscope="true" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text"><p>Some of the top reasons to invest in villas in Dubai include low taxes on property, a high rate of occupancy which ensures high returns for investors, a high-standard of living, and a convenient lifestyle with easy access to top-notch facilities from hospitals to gyms.</p></div></div></div><div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question"><h3 itemprop="name">Is it worth buying a house in Dubai?</h3><div itemscope="true" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text"><p>Depending on your short and long-term financial goals, Dubai can be a very good place to buy a home to either live in or invest. To protect yourself against fluctuating rent prices yearly, it may be a good idea to purchase a home if you plan to be in the city from medium to long-term. The property investor visa, no property taxes, high rental yields and relatively low service charges also make Dubai a very attractive place to purchase a home.</p></div></div></div></div></div>
	<!-- <button class="btn open-enquiry">request information</button> -->
	</div>
	<!-- <div class="mrg-top-20 lh28">
	<span class="mrg-right-20">You can also browse: </span>
	<div class="tags" style="display:inline">
	<a href="/" class="tag">Apartments for sale in Dubai </a>
	<a href="/" class="tag">Villas for rent in Dubai </a>
	<a href="/" class="tag">Apartments for rent in Dubai </a>
	</div>
	</div> -->
	</div>
	<div class="brd-top mrg-top-60"></div>
	<div class="mp__links mrg-top-30">
<!-- 	<div>
	<p class="f18 white mrg-bottom-20 mrg-top-auto">Popular searches</p>
	<div class="tags">
	<a href="/" class="tag">3 bedroom villa for Sale in Dubai </a>
	<a href="/" class="tag">4 bedroom villa for Sale in Dubai </a>
	<a href="/" class="tag">5 bedroom villa for Sale in Dubai </a>
	<a href="/" class="tag">6 bedroom villa for Sale in Dubai </a>
	<a href="/" class="tag">7 bedroom villa for Sale in Dubai </a>
	<a href="/" class="tag">8 bedroom villa for Sale in Dubai </a>
	</div>
	</div> -->
	</div>
	<div class="brd-top mrg-top-60"></div>
	<div class="cf-group mrg-top-30">
	<p class="f18 white mrg-bottom-20 mrg-top-auto">From The Journal</p>
	<div class="mobile-slider" style="padding-left:0px;">
	<div class="list inner">
	<div class="row pw100 left">
	    
		@foreach($Journals as $Journal)    
	<div class="column-33 article">
	<article id="article_936" class="list-item no-brd mrg-auto">
	<a href="{!! url('Journal/'.$Journal->id ) !!}" title="Read article">
	<img style="max-height: 225px;" src="<?php echo asset("assets/allimages/$Journal->picture")?>" alt="The Menu: Breaking bread with Solemann Haddad" class="full-width-responsive" loading="lazy" width="377" height="227">
	<div class="text-left">
	<p class="f14 mrg-top-20">{!! $Journal->Publish_date !!}</p>
	<h2 class="tw light-silver hover uppercase mrg-top-5 mrg-bottom-20 title-eq tablet-text-left">{!! $Journal->journal_title !!}</h2>
	<p class="f16 lh20 mrg-bottom-30 text-left">{!! substr($Journal->description,0,150) !!}</p>
	</div>
	</a>
	</article>
	</div>
	@endforeach

	<div  class="modal myModalAll" tabindex="-1" role="dialog">
		<div class="col-md-8 offset-md-2 col-12 mt-5" role="document">
			<div style="background-color: black; border: 5px solid #222;" class="modal-content">
				<div class="modal-body p-4">
					<div class="col-12">
						<h3 class="text-light">Enquire about Dubai </h3>
						<p class="text-grey d-md-block d-none">Contact our Luxury Specialist on +971 44 55 08 88 or kindly provide your details below
						</p>
					</div>

					<div class="row">
						<div class="col-md-6 col-12 mb-3">	
                        <img style="height: 200px" class="img-fluid w-100"src="{!! config('urls.web_cdn_url') . '/assets/allimages' !!}/modalimage.JPG" >
						</div>
						<div class="col-md-6 col-12">
							<form method="POST" action="{{url('sale/save-request-from-user')}}" enctype="multipart/form-data">
								@csrf

								<input  style="height: 40px;border: none; " class="form-group w-100 " type="text" name="name" placeholder="Full Name" required>
								<input  style="height: 40px;border: none; " class="form-group w-100 " type="email" name="email" placeholder="Email" required>
								<input  style="height: 40px;border: none; " class="form-group w-100 " type="tel" name="phone" placeholder="Phone Number" id="mobile-number" required>
								<input  style="height: 40px;border: none; " class="form-group w-100 " type="text" name="description" placeholder="Inquiry message" required>
								<input  style="height: 40px;border: none; " class="form-group w-100 " type="hidden" name="user_request_type" value="buy">
								<div class="col-12 text-center m-0 p-0">
									<button style="background-color:white; border: 1px solid white;  color: black  ;" class="btn btn-lg text-center btn-block mt-3">Submit Enquiry</button>
								</div>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	

	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</aside>
	</main>



@include('includes.footer')


<script type="text/javascript">
     

	$(".faq-item").click(function(){
		$(".faq-item").removeClass("active");
		$(this).addClass("active");
		
	});



	$( document ).ready(function() {

		$( ".request" ).click(function() {
			$(".myModalAll").modal("toggle")
		});


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

</script>


@endsection