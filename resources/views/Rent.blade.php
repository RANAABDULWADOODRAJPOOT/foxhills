@extends('lux_habitate')


@section('content')


@if( ! Agent::isMobile())
@include('partials.homeScreenFilter')
@endif


<section class="container-fluid ">
	@if(Agent::isMobile())
	<div class="justify-content-center">
		@else
		<div class="row justify-content-center">
			@endif
		<div class="col-md-10 col-12">
			<p class="text-grey text-center my-3">Home > Dubai</p>
			<h1 class="text-light text-center">LUXURY PROPERTIES FOR RENT IN DUBAI</h1>
			<div style="background-color: #222;border-bottom: 1px solid #999 " class="row justify-content-center mt-5">
				<div class="col-md-6  col-12 my-md-5 my-2">
					<P class="text-grey mt-3">LUXHABITAT Sotheby's presents many excellent luxury properties for sale in Dubai. These homes are designed and created with some of the best materials sourced from all around the world. The properties for sale that are available in the Dubai market are beautifully made and emphasise the luxury lifestyle that Dubai exudes. Our expert luxury sales specialists can guide you through the whole process from start to finish. You can choose from a selection of apartments, villas, penthouses, lofts, and duplexes, and even purchase a plot to create your dream home.</P>
					<button style="border: 1px solid white; border-radius: 10px; color: BLACK  ;" class="btn btn-md my-3">Register Your Interest</button>
				</div>
				<div class="col-md-6  col-12 my-md-5 my-2">
					@if(Agent::isMobile())
					<div style="border:2px solid #222" >
						<img style="height: 200px" class="img-fluid w-100"src="{!! config('urls.web_cdn_url') . 'assets/allimages' !!}/modalimage.jpg" >
					</div>
					@else
					<div style="border:2px solid #222" >
						<img style="height: 300px" class="img-fluid w-100"src="{!! config('urls.web_cdn_url') . 'assets/allimages' !!}/modalimage.jpg" >
					</div>
					@endif
				</div>
			</div>
			<div class="row">
			<div class="col-12 pt-2 pb-3 custom-filter horizontal-scroll smart-bar mt-3  p-0">
				@foreach($allPropertyTypes as $allPropertyType)
				<a style="border: 1px solid #222; color: #999; border-radius: 30px" class=" btn  px-3 mb-2 box-shadow-sm font-size-xs p-2">{!! $allPropertyType->title !!}</a>
				@endforeach
				</div>
			<div class="col-12 mb-4 p-0">
				<h2 class="text-light">Featured Development</h2>
			</div>
			@if(Agent::isMobile())
			<div style=" overflow-x: scroll;" class="row flex-row d-flex flex-nowrap horizontal-scroll">
				@else
				<div class="row w-100 mt-5">
					@endif

					@foreach($rentproducts as $rentproduct)
					<div class="col-md-4  col-12 mb-3">
						<a href="{!! url('rent/'.$rentproduct->id ) !!}">
						<div style="border:2px solid #222" >
							<img style="height: 250px;" class=" img-fluid w-100" src="{!! config('urls.web_cdn_url') . 'assets/allimages' !!}/{!! $rentproduct->picture  !!}" >
							<div class="px-3">
								<h3 class="mt-3 mb-2 text-light">{!! $rentproduct->productname !!}</h3>
								<p class="mb-0 text-grey">{!! $rentproduct->Area !!}</p>
								<p class="mb-0 text-grey"><Span>{!! $rentproduct->propertyType->title !!} | {!! $rentproduct->Bedrooms !!} | {!! $rentproduct->length !!}</Span></p>
								<h4 class="mt-2 mb-3 text-light"> AED {!! number_format($rentproduct->Price, 0, ',', ','); !!}</h4>
							</div>
						</div>
					</a>
					</div>
					  @endforeach

					    <Span class="mt-5">
                	{!! $userproducts->links();  !!}
                </Span>

				</div>
			</div>
				<div style="border-top: 1px solid #999 ;border-bottom: 1px solid #999 " class="row justify-content-center mt-5">
					<div class="col-md-6  col-12 my-md-5 my-2 p-0">
						<h2 class="text-light">Learn more about our Properties for Sale in Dubai </h2>
						<P style="font-size: 19px;" class="text-grey mt-3">Dubai has become one of the favourite destinations for second-hand property buyers worldwide. Several people are attracted to its comfortable lifestyle, cosmopolitan environment and subtropical climate. It also offers outstanding and safe investment opportunities, with many high quality projects launching every month and a steady return on investment.</P>
						<button style="border: 1px solid white; border-radius: 10px; color: BLACK  ;" class="btn btn-md my-3">Request Information</button>
					</div>
					<div class="col-md-6  col-12 my-md-5 my-2 p-0">
					</div>
				</div>
				<div class="row">
					<div class="col-12 my-4 p-md-0 p-0">
						<h4 class="text-light">Popular searches</h4>
						<a style="border: 1px solid #222; color: #999; border-radius: 30px" class=" btn  px-3 mt-2 box-shadow-sm font-size-xs p-2">1 bedroom apartment for Sale in Dubai </a>
						<a style="border: 1px solid #222; color: #999; border-radius: 30px" class=" btn  px-3 mt-2 box-shadow-sm font-size-xs p-2">2 bedroom apartment for Sale in Dubai </a>
						<a style="border: 1px solid #222; color: #999; border-radius: 30px" class=" btn  px-3 mt-2 box-shadow-sm font-size-xs p-2">8 bedroom villa for Sale in Dubai </a>
						<a style="border: 1px solid #222; color: #999; border-radius: 30px" class=" btn  px-3 mt-2 box-shadow-sm font-size-xs p-2">4 bedroom villa for Sale in Dubai  </a>
						<a style="border: 1px solid #222; color: #999; border-radius: 30px" class=" btn  px-3 mt-2 box-shadow-sm font-size-xs p-2">1 bedroom apartment for Sale in Dubai </a>
						<a style="border: 1px solid #222; color: #999; border-radius: 30px" class=" btn  px-3 mt-2 box-shadow-sm font-size-xs p-2">2 bedroom apartment for Sale in Dubai </a>
						<a style="border: 1px solid #222; color: #999; border-radius: 30px" class=" btn  px-3 mt-2 box-shadow-sm font-size-xs p-2">3 bedroom villa for Sale in Dubai </a>
						<a style="border: 1px solid #222; color: #999; border-radius: 30px" class=" btn  px-3 mt-2 box-shadow-sm font-size-xs p-2">6 bedroom villa for Sale in Dubai  </a>
					</div>
					<div class="col-12 my-4 p-0">
						<h2 class="text-light">THE JOURNAL</h2>
					</div>
					@if(Agent::isMobile())
					<div style=" overflow-x: scroll;" class="row flex-row d-flex flex-nowrap horizontal-scroll mb-3">
						@else
						<div class="row w-100 my-5">
							@endif

							@foreach($Journals as $Journal)
							<div class="col-md-4  col-12 mb-3">

								<img style="height: 250px;" class=" img-fluid w-100" src="{!! config('urls.web_cdn_url') . 'assets/allimages' !!}/{!! $Journal->picture !!}" >
								<div class="px-3">
									<p class="mb-0 text-grey mt-3">{!! $Journal->Publish_date !!}</p>
									<h3 class="mt-3 mb-2 text-light">{!! $Journal->journal_title !!}</h3>
									<p class="mb-0 text-grey">{!! substr($Journal->description,0,300) !!} </p>
								</div>

							</div>
							<div class="col-md-12  col-12">
								<a href="{!! url('Journal/'.$Journal->id ) !!}" style="border: 1px solid white; border-radius: 10px; color: white  ;" class="btn btn-md my-4">View ALL Articles</a>
							</div>
							@endforeach
							
						</div>
					</section>
				</div>
			</div>
		</section>




		<script type="text/javascript">
			$( document ).ready(function() {
				$("#Firstdropdown").hide();
			});
		</script>











		@include('includes.footer')
	</div>
</section>



@endsection