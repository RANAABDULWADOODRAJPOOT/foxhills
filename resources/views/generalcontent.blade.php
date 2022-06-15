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
			@if(Agent::isMobile())
			<div style=" overflow-x: scroll;" class="row flex-row d-flex flex-nowrap horizontal-scroll">
				@else
					<div class="col-12 p-0">
				@endif
			
		</div>
             
            @if(!empty($GeneralContents))

			<div style="border-bottom: 1px solid #222;" class="row py-5">
				<div class="col-md-8 offset-md-2 col-12 p-0">
					<h1 class="my-4 text-light text-center">{!! $GeneralContents->productname !!}</h1>
					<img style="height:500px;" class=" img-fluid w-100" src="{!! config('urls.web_cdn_url') . '/assets/allimages' !!}/{!! $GeneralContents->picture !!}" >
				    <p style="font-size:18px;" class="my-4 text-light">{!! $GeneralContents->Description !!}</p>
				</div>
			</div>
			@endif
			
		</div>
	
		@include('includes.footer')
</div>
</section>




@endsection