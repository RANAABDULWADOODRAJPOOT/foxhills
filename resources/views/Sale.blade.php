@extends('lux_habitate')
@section('content')
@if( ! Agent::isMobile())
@include('partials.homeScreenFilter')
@endif





<section class="container-fluid text-center">
	<div class="row">
		<div  class="col-12 text-center">
			<img style="z-index: -1; " class="img-fluid w-100 {!!  (Agent::isMobile()) ? 'bannerheight' : '' !!}"  src="<?php echo asset("assets/allimages/salesbanner.jpg")?>" >
			
			@if(Agent::isMobile())	
			<div style="margin-top:-180px">
				<h1 style="font-size: 25px;" class="gallery-title text-light">Sell your property with us</h1>
				<p style="font-size: 18px; margin-bottom: 5px;" class="gallery-title text-light">exceptional home that deserves an exceptional service, we would love to help.</p>
				<button id="saleRequest" style="background-color:black; border: 1px solid white; border-radius: 10px; color: white  ;" class="btn btn-sm">Request a market appraisal</button>
			</div>
			@else
			<div style="margin-top:-270px">
				<h1 style="font-size: 70px;" class="gallery-title text-light">Sell your property with us</h1>
				<p style="font-size: 20px;" class="gallery-title text-light">If you have an exceptional home that deserves an exceptional service, we would love to help.</p>
				<button id="saleRequest" style="background-color:black; border: 1px solid white; border-radius: 10px; color: white  ;" class="btn btn-md">Request a market appraisal</button>
			</div>
			#@endif
		</div>
	</div>
</section>

<section style="{!!  (Agent::isMobile()) ? 'margin-top:60px;' : 'margin-top:100px;' !!}" class="container-fluid ">
	<div class="row  justify-content-center">
		<div class="col-md-10 col-12">
			<div class="col-md-12 col-12 p-0 text-center">
				<h5 class="standard mt-md-5 mt-4 ">OUR PORTFOLIO</h5>
				<p class="text-grey my-3 text-center">By acting as a filter for the best properties on the market we attract buyers who place the quality of the home at the centre of their search. By turning down almost as much work as we take on, we keep the standards of our offering high. This quality control means that buyers trust our ability to show them only what’s worth seeing</p>
			</div>
			<div class="row my-5">
				<div class="col-md-6 col-12">
					<img style="height:300px" class="img-fluid w-100 mb-4 mb-md-1"  src="<?php echo asset("assets/allimages/image1.jpg")?>" >
				
				</div>
				<div class="col-md-6 col-12">
					<img style="height:300px" class="img-fluid w-100  mb-4 mb-md-1" src="	<?php echo asset("assets/allimages/image2.jpg")?>" >
				</div>
			</div>
			<h2>UNRIVALED EXPOSURE</h2>
			<div style="border-top: 1px solid #999 ;border-bottom: 1px solid #999 " class="row my-5">
				<div class="col-md-6 col-12 text-center my-md-5 my-3">
					<p class="text-grey">INTERNATIONAL REACH</p>
					<p  style="font-size:18px;font-weight: 600;" class="text-light">1.5M+ WEBSITE USERS</p>
					<p class="text-grey">Our multi-award-website attracts more than 1.5m+ users a year, with 75% of traffic coming from international countries such as the United Kingdom, India, GCC countries and China.</p>
				</div>
				<div class="col-md-6 col-12 text-center my-md-5 my-3">
					<p class="text-grey">INTERNATIONAL REACH</p>
					<p  style="font-size:18px;font-weight: 600;" class="text-light">12+ articles/month</p>
					<p class="text-grey">Our multi-award-website attracts more than 1.5m+ users a year, with 75% of traffic coming from international countries such as the United Kingdom, India, GCC countries and China.</p>
				</div>
				<div class="col-md-6 col-12 text-center my-md-5 my-3">
					<p class="text-grey">INTERNATIONAL REACH</p>
					<p  style="font-size:18px;font-weight: 600;" class="text-light">10x exposure</p>
					<p class="text-grey">Our multi-award-website attracts more than 1.5m+ users a year, with 75% of traffic coming from international countries such as the United Kingdom, India, GCC countries and China.</p>
				</div>
				<div class="col-md-6 col-12 text-center my-md-5 my-3">
					<p class="text-grey">INTERNATIONAL REACH</p>
					<p  style="font-size:18px;font-weight: 600;" class="text-light">1.5M+ WEBSITE USERS</p>
					<p class="text-grey">Our multi-award-website attracts more than 1.5m+ users a year, with 75% of traffic coming from international countries such as the United Kingdom, India, GCC countries and China.</p>
				</div>
			</div>
			<div class="col-md-6 col-12 p-0">
				<h5 class="standard">Storytelling</h5>
				<p class="text-grey my-3">By acting as a filter for the best properties on the market we attract buyers who place the quality of the home at the centre of their search. By turning down almost as much work as we take on, we keep the standards of our offering high. This quality control means that buyers trust our ability to show them only what’s worth seeing</p>
			</div>
			<div style="border-bottom: 1px solid #999 " class="row justify-content-center my-5">
				<div class="col-md-6  col-12 my-md-5 my-2">
					<h2 class="text-light">Our Team</h2>
					<P class="text-grey mt-3">Our Luxury Sales Specialists will offer you the best of services and expertise to keep in mind before buying or selling your property. Each of them specialise in at least one area in Dubai and know it from a hyperlocal level. Their networking and negotiating skills will ensure that you get the results you want - whether it's a sound property investment, purchasing a property or getting the right price for your property.</P>
					<button style="border: 1px solid white; border-radius: 10px; color: BLACK;background:white;" class="btn btn-md my-3">FIND AN AGENT</button>
				</div>
				<div class="col-md-6  col-12 my-md-5 my-2">
					<div style="border:2px solid #222" >
						<img class="img-fluid w-100"src="<?php echo asset("assets/allimages/expert.jpg")?>">
					</div>
				</div>
			</div>
			<div class="col-12 my-4 p-0">
				<h2 class="text-light">THE JOURNAL</h2>
			</div>
			@if(Agent::isMobile())
			<div style=" overflow-x: scroll;" class="row flex-row d-flex flex-nowrap horizontal-scroll mb-3">
				@else
				<div class="row  mt-5">
					@endif
					@foreach($Journals as $Journal)
			<div class="col-md-4  col-12 mb-3">

				<img style="height: 250px;" class=" img-fluid w-100" src="<?php echo asset("assets/allimages/{$Journal->picture}")?>" >
				<div class="px-3">
					<p class="mb-0 text-grey mt-3">{!! $Journal->Publish_date !!}</p>
					<h3 class="mt-3 mb-2 text-light">{!! $Journal->journal_title !!}</h3>
					<p class="mb-0 text-grey">{!! substr($Journal->description,0,300) !!} </p>
			

			</div>
			<div class="col-md-12  col-12">
				<a href="{!! url('Journal/'.$Journal->id ) !!}" style="border: 1px solid white; border-radius: 10px; color: white  ;" class="btn btn-md my-4">View ALL Articles</a>
			</div>
			</div>
			@endforeach
		</div>
			<div style="border-top: 1px solid #999 ;border-bottom: 1px solid #999 "  class="col-md-12 col-12 py-4 p-md-0 mt-2">
				<h5 class="standard mt-3">Global Network</h5>
				<p class="text-grey my-3">When your home is represented by us it benefits from the world’s largest luxury real estate network and gains exclusive access to highly qualified international clientele.</p>
				<div class="row my-md-5">
					<div class="col-md-3 col-12 text-center">
						<h2 style="font-size:33px;">1,000</h2>
						<p class="text-grey">Offices worldwide</p>
					</div>
					<div class="col-md-3 col-12  text-center">
						<h2 style="font-size:33px;">70</h2>
						<p class="text-grey">Sales associates</p>
					</div>
					<div class="col-md-3 col-12 text-center">
						<h2 style="font-size:33px;">65</h2>
						<p class="text-grey">Countries & territories</p>
					</div>
					<div class="col-md-3 col-12  text-center">
						<h2 style="font-size:33px;">85</h2>
						<p class="text-grey">Annual sales</p>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-12 p-md-0 my-5">
				<h5 class="standard">Track record</h5>
				<p class="text-grey my-3">We have the experience to sell your property as we’ve done it before. Since we started in 2009, we have represented thousands of properties in the more prestigious areas of the country. We have seen a huge amount of change: in the market, in the way that property is sold and, most importantly, in the way that people want to live. Our experience, insight and leadership allows us to understand the modern buyer better than any other agent.</p>
			</div>
			
			<div class="col-md-12 mb-5 p-md-0 col-12">
				<h5 class="standard">Looking to sell an exceptional home?</h5>
				<p class="text-grey my-3">Then we would love to hear from you. We'll match you with a Specialist that knows your area best. Fill out the form below, or call +971 44 55 08 88 to get started right away.</p>
				<button style="background-color:white; border: 1px solid white; border-radius: 10px; color: black  ;" class="btn btn-md">Request a market appraisal</button>
			</div>
		</div>
	</div>
</section>





<div  class="modal myModalsale" tabindex="-1" role="dialog">
	<div class="col-md-8 offset-md-2 col-12 mt-5" role="document">
		<div style="background-color: black; border: 5px solid #222;" class="modal-content">
			<div class="modal-body p-4">
				<div class="col-12">
					<h3 class="text-light">Enquiry about listing ID GS-S-36262</h3>
					<p class="text-grey d-md-block d-none">Contact our Luxury Specialist on +971 44 55 08 88 or kindly provide your details below
					</p>
				</div>
				<div class="row">
					<div class="col-md-6 col-12 mb-3">
						<img  class=" img-fluid w-100"  src="<?php echo asset("assets/allimages/modalimage.jpg")?>">	
					
					</div>
					<div class="col-md-6 col-12">
						<form method="POST" action="{{url('sale/save-request-from-user')}}" enctype="multipart/form-data">
							@csrf
							<input  style="height: 40px;border: none; " class="form-group w-100 " type="" name="name" placeholder="Full Name" required>
							<input  style="height: 40px;border: none; " class="form-group w-100 " type="" name="email" placeholder="Email" required>
							<input  style="height: 40px;border: none; " class="form-group w-100 " type="" name="phone" placeholder="phone" required>
							<input  style="height: 40px;border: none; " class="form-group w-100 " type="" name="description" placeholder="I'd like to have more information about the property ID GS-S-36262" required>
							<input  style="height: 40px;border: none; " class="form-group w-100 " type="hidden" name="user_request_type"  value="sale">
							<div class="col-12 text-center">
								<button style="background-color:white; border: 1px solid white; border-radius: 10px; color: black  ;" class="btn btn-md text-center mt-3">Submit Enquiry</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




<script type="text/javascript">
	$( "#saleRequest" ).click(function() {
		$(".myModalsale").modal("toggle")
	});
</script>



		@include('includes.footer')




@endsection