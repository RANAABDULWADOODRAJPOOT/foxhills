@extends('lux_habitate')
@section('content')

@if( ! Agent::isMobile())
@include('partials.homeScreenFilter')
@endif



<section class="container-fluid ">
	@if(Agent::isMobile())
	<div class="justify-content-center">
		@else
		<div class="row justify-content-center pt-5 pb-5">
			
			@endif
		<div class="col-md-12 col-12">
			{{-- <p class="text-grey text-center my-3 ">Home > The Journal</p> --}}
			<h1  class="text-light text-center my-3">The Journal</h1>
			<p class="mb-md-0 text-muted text-center">The online journal of luxury homes, design, interiors, art and style</p>

			<div class="row">
				<div class="sticky-hoz-list">
					<div class="selected">
					<span>All categories</span>
					<svg fill="#000000" height="36" viewBox="0 0 24 24" width="36" xmlns="http://www.w3.org/2000/svg">
					<path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
					<path d="M0 0h24v24H0z" fill="none"></path>
					</svg> </div>
					<ul>
						<li><a href="{!! url('Journal/cat/0') !!}" class="{{ Request::is('Journal/cat/0') ? 'text-white' : '' }}">All categories</a></li>
					  @foreach($category as $head)
						  <li ><a href="{!! url('Journal/cat/'.$head->id ) !!}"  class="{{ Request::is('Journal/cat/'.$head->id) ? 'text-white' : '' }}">{!! $head->name !!}</a></li>
					  @endforeach
						  
					  </ul>
					</div>
			</div>
			<hr class="text-light">
			{{-- @if(Agent::isMobile()) --}}
			{{-- <div style="overflow-x: hidden;overflow:visible;" class="row flex-row d-flex flex-nowrap horizontal-scroll sticky-hoz-list">
				@else
					<div class="col-12 p-0">
				@endif --}}
				
			{{-- <ul style=" list-style-type: none;padding-left: 10px; display: flex; justify-content: center;m-auto">
			  <li class="text-muted-filter my-2 mr-3"  style="font-size:16px;"><a href="{!! url('Journal/cat/0') !!}">All categories</a></li>
            @foreach($category as $head)
				<li class="text-muted-filter my-2 mr-3"  style="font-size:16px;"><a href="{!! url('Journal/cat/'.$head->id ) !!}">{!! $head->name !!}</a></li>
			@endforeach
				
			</ul> --}}






	
		{{-- </div> --}}

			<div style="border-bottom: 1px solid #222;" class="row p-0 m-0 pb-5 py-3 container justify-content-center m-auto">
              @foreach($MostviewJournals as $Journal)
			  <a href="{!! url('Journal/'. $Journal->id ) !!}" class="row container p-0 m-0">
				<div class="col-md-6 col-12 p-0">
					<img class=" img-fluid w-100 mb-journal-top" src="<?php echo asset("assets/allimages/{$Journal->picture}")?>" >
				</div>
				
				<div class="col-md-6 col-12 p-md-3 p-0 py-2 float-left">
					{{-- <p class="text-grey">{!! $Journal->journal_type   !!} </p> --}}
					<h1 class="text-light text-left ml-0 mr-0 pl-0 pr-0">{!! $Journal->journal_title !!}</h1>
					<p class="text-grey ">{!! substr($Journal->description,0,100) !!} </p>
				</div>
			  </a>
				<?php break; ?>
	         @endforeach
			</div>


			{{-- <div class="col-12 my-4 p-0">
				<h2 class="text-light">THE JOURNAL</h2>
			</div> --}}
			{{-- @if(Agent::isMobile()) --}}
			{{-- <div style=" overflow-x: scroll;" class="row flex-row d-flex flex-nowrap horizontal-scroll m-sm-auto container"> --}}
				{{-- @else --}}
				<div class="row w-100 my-5 m-0 container p-0 m-auto">
					{{-- @endif --}}
                    
                    @foreach( $AllJournals as $jour)
					<div class="col-md-4  col-12 mb-3 {{ Agent::isMobile() ? 'p-0' : '' }}">
						
					        <img style="height: 250px;" class=" img-fluid w-100" src="<?php echo asset("assets/allimages/{$jour->picture}")?>" >
							<div class="p-0">
								<p class="mb-0 text-grey mt-3">{!!  $jour->Publish_date !!}</p>
								<h3 class="mt-3 mb-2 text-light">{!! $jour->journal_title !!}</h3>
								<p class="mb-0 text-grey">{!! substr( $jour->description,0,150) !!} </p>
							</div>
						
					
					<div class="col-md-12  col-12 p-0">
						<a href="{!! url('Journal/'. $jour->id ) !!}" style="border: 1px solid white; border-radius: 10px; color: white  ;" class="btn btn-md my-4">View  Articles</a>
					</div>
				</div>
					@endforeach

					
                	{{-- {!! $items->links();  !!} --}}
				
					


				</div>	
				
				
		 {{-- </div> --}}
		 <div class="row m-auto float-right pt-5 pb-5">
			{{ $AllJournals->links(); }}
		</div>
		{{-- </div> --}}




		<script type="text/javascript">
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
         	var  redirecturl = pathname +  '/'  +  'filters' + '?' + 'Category=' +  Category + '&' + 'propertytypeid=' +  typeid + '&' + 'minsize=' +  minsize + '&' +  'maxsize=' +  maxsize + '&' +  'Bedrooms=' +  bedrooms +  '&'  +  'minprice=' +  minprice + '&' +  'maxprice=' +  maxprice ;
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
			var  redirecturl = pathname  + '/'  +  'filters' + '?' + 'Category=' +  Category + '&' + 'propertytypeid=' +  typeid + '&' + 'minsize=' +  minsize + '&' +  'maxsize=' +  maxsize + '&' +  'Bedrooms=' +  bedrooms +  '&'  +  'minprice=' +  minprice + '&' +  'maxprice=' +  maxprice ;
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
		    var  redirecturl = pathname + '/'  +  'filters' + '?' + 'Category=' +  Category + '&' + 'propertytypeid=' +  typeid + '&' + 'minsize=' +  minsize + '&' +  'maxsize=' +  maxsize + '&' +  'Bedrooms=' +  bedrooms +  '&'  +  'minprice=' +  minprice + '&' +  'maxprice=' +  maxprice ;
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

	
		


</section>




@include('includes.footer')
@endsection
</div>