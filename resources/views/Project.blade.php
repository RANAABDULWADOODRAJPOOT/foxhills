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
				<p class="text-grey text-center my-3 ">Home > Curated Projects > Dubai</p>
				<h1  class="text-light text-center my-3">Curated Projects in Dubai </h1>
				<p class="mb-md-0 text-muted text-center">New developments and curated quality investment options in the off-plan market in Dubai </p>
			</div>
		</div>
		<div class="row justify-content-center">


			@foreach($projectProducts as $projectProduct)
			<div style="border-bottom : 1px solid #222" class="col-md-10 col-12 my-3 py-5">
				<div class="row">
					<div class="col-md-4 col-12">
						<img class=" img-fluid w-100" src="{!! config('urls.web_cdn_url') . 'assets/allimages' !!}/{!! $projectProduct->picture !!}" >
					</div>
					<div class="col-md-6 col-12">
						<h3 class="text-white mt-md-1 mt-3">{!! $projectProduct->productname !!}</h3>
						<p class="text-grey">by LIV Real Estate</p>
						<div class="d-md-flex justify-content-between mb-md-3 mb-2">
							<div>
								<span style="font-size:17px;" class="text-light">Price</span>
								<span class="text-grey mx-3">{!! $projectProduct->Price !!} </span>
							</div>
							<div>
								<span style="font-size:17px;"  class="text-light">Built up area:</span>
								<span class="text-grey mx-3"> {!! $projectProduct->length !!}</span>
							</div>
						</div>
						<div class="d-md-flex justify-content-between">
							<div>
								<span style="font-size:17px;" class="text-light">Completion:</span>
								<span class="text-grey mx-3">{!! $projectProduct->Completion !!}</span>
							</div>
							<div>
								<span style="font-size:17px;" class="text-light">Property types:</span>
								<span class="text-grey mx-3">{!! $projectProduct->propertyType->title !!}</span>
							</div>
						</div>
						<a href="{{ url('project/'.$projectProduct->id ) }}"   style="background-color:white; border: 1px solid white; border-radius: 10px; color: black  ;" class="btn btn-sm mt-4">View the property</a>
					</div>
				</div>
			</div>
			  @endforeach
		
		</div>

				@include('includes.footer')
	</div>
</section>

@endsection