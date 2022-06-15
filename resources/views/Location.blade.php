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
			<p class="text-grey text-center my-3 ">Home > Dubai</p>
			<h1  class="text-light text-center my-3">Selected Areas & Neighbourhoods</h1>
			<p class="mb-md-0 text-muted text-center">Browse our selection of the best areas and neighborhoods to live and work</p>
			
			<div class="row">
				@if(Agent::isMobile())
			<div style=" overflow-x: scroll;" class="row flex-row d-flex flex-nowrap horizontal-scroll">
				@else
				<div class="row w-100  mt-5">
					@endif

					@foreach($locationproducts as $locationproducts)
					<div class="col-md-4  col-12 mb-3">
							<a href="{!! url('location/'.$locationproducts->id ) !!}">
						<div style="border:2px solid #222" >
							<img style="height: 250px;" class=" img-fluid w-100" src="{!! config('urls.web_cdn_url') . 'assets/allimages' !!}/{!! $locationproducts->picture  !!}" >
							<div class="px-3">
								<h3 class="mt-3 mb-2 text-light">{!! $locationproducts->productname  !!}</h3>
								<p class="mb-0 text-grey">{!! $locationproducts->Area  !!}</p>
								<p class="mb-0 text-grey"><Span>{!! $locationproducts->propertyType->title  !!} | {!! $locationproducts->Bedrooms  !!} | {!! $locationproducts->length  !!}</Span></p>
								<h4 class="mt-2 mb-3 text-light">{!! $locationproducts->Price  !!}</h4>
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
				
		 </div>
		</div>
	</div>
		@include('includes.footer')
</div>
</section>




@endsection