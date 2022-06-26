@extends('lux_habitate')
@section('content')

@if( ! Agent::isMobile())
@include('partials.homeScreenFilter')
@endif



<section class="container-fluid ">
	@if(Agent::isMobile())
	<div class="justify-content-center">
		@else
		<div class="row justify-content-center p-5">
			@endif
		<div class="col-md-12 col-12">
			{{-- <p class="text-grey text-center my-3 ">Home > The Journal</p> --}}
			<h1  class="text-light text-center my-3">The Journal</h1>
			<p class="mb-md-0 text-muted text-center">The online journal of luxury homes, design, interiors, art and style</p>
			<hr class="text-light">
			@if(Agent::isMobile())
			<div style=" overflow-x: scroll;" class="row flex-row d-flex flex-nowrap horizontal-scroll">
				@else
					<div class="col-12 p-0">
				@endif
				
			<ul style=" list-style-type: none;padding-left: 10px; display: flex; justify-content: center;">
			  <li class="text-muted-filter my-2 mr-5"><a href="{!! url('Journal/cat/0') !!}">All categories</a></li>
            @foreach($category as $head)
				<li class="text-muted-filter my-2 mr-5"><a href="{!! url('Journal/cat/'.$head->id ) !!}">{!! $head->name !!}</a></li>
			@endforeach
				
			</ul>
		</div>

			{{-- <div style="border-bottom: 1px solid #222;" class="row pb-5 py-3">
              @foreach($MostviewJournals as $Journal)
				<div class="col-md-6 col-12 p-0">
					<img class=" img-fluid w-100" src="<?php echo asset("assets/allimages/{$Journal->picture}")?>" >
				</div>
				
				<div class="col-md-6 col-12 p-md-3 p-0 py-2 float-left {!!  (Agent::isMobile()) ? '' : 'margin-450 ' !!}">
					<p class="text-grey">{!! $Journal->journal_type   !!} </p>
					<h1 class="text-light text-left ml-0 mr-0 pl-0 pr-0">{!! $Journal->journal_title !!}</h1>
					<p class="text-grey ">{!! substr($Journal->description,0,100) !!} </p>
				</div>
	         @endforeach
			</div> --}}


			{{-- <div class="col-12 my-4 p-0">
				<h2 class="text-light">THE JOURNAL</h2>
			</div> --}}
			@if(Agent::isMobile())
			<div style=" overflow-x: scroll;" class="row flex-row d-flex flex-nowrap horizontal-scroll m-sm-auto">
				@else
				<div class="row w-100 my-5">
					@endif
                    
                    @foreach( $AllJournals as $jour)
					<div class="col-md-4  col-12 mb-3">
						
					        <img style="height: 250px;" class=" img-fluid w-100" src="<?php echo asset("assets/allimages/{$jour->picture}")?>" >
							<div class="px-3">
								<p class="mb-0 text-grey mt-3">{!!  $jour->Publish_date !!}</p>
								<h3 class="mt-3 mb-2 text-light">{!! $jour->journal_title !!}</h3>
								<p class="mb-0 text-grey">{!! substr( $jour->description,0,150) !!} </p>
							</div>
						
					
					<div class="col-md-12  col-12">
						<a href="{!! url('Journal/'. $jour->id ) !!}" style="border: 1px solid white; border-radius: 10px; color: white  ;" class="btn btn-md my-4">View  Articles</a>
					</div>
				</div>
					@endforeach

					
                	{{-- {!! $items->links();  !!} --}}
				
					


				</div>	
				
				
		 </div>
		 <div class="row m-auto float-right p-5">
			{{ $AllJournals->links(); }}
		</div>
		</div>




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
         	var  redirecturl = pathname + '/LUXHABITAT/public/index.php' + '/'  +  'filters' + '?' + 'Category=' +  Category + '&' + 'propertytypeid=' +  typeid + '&' + 'minsize=' +  minsize + '&' +  'maxsize=' +  maxsize + '&' +  'Bedrooms=' +  bedrooms +  '&'  +  'minprice=' +  minprice + '&' +  'maxprice=' +  maxprice ;
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
			var  redirecturl = pathname + '/LUXHABITAT/public/index.php' + '/'  +  'filters' + '?' + 'Category=' +  Category + '&' + 'propertytypeid=' +  typeid + '&' + 'minsize=' +  minsize + '&' +  'maxsize=' +  maxsize + '&' +  'Bedrooms=' +  bedrooms +  '&'  +  'minprice=' +  minprice + '&' +  'maxprice=' +  maxprice ;
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
			var  redirecturl = pathname + '/LUXHABITAT/public/index.php' + '/'  +  'filters' + '?' + 'Category=' +  Category + '&' + 'propertytypeid=' +  typeid + '&' + 'minsize=' +  minsize + '&' +  'maxsize=' +  maxsize + '&' +  'Bedrooms=' +  bedrooms +  '&'  +  'minprice=' +  minprice + '&' +  'maxprice=' +  maxprice ;
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
		    var  redirecturl = pathname + '/LUXHABITAT/public/index.php' + '/'  +  'filters' + '?' + 'Category=' +  Category + '&' + 'propertytypeid=' +  typeid + '&' + 'minsize=' +  minsize + '&' +  'maxsize=' +  maxsize + '&' +  'Bedrooms=' +  bedrooms +  '&'  +  'minprice=' +  minprice + '&' +  'maxprice=' +  maxprice ;
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
		    var  redirecturl = pathname + '/LUXHABITAT/public/index.php' + '/'  +  'filters' + '?' + 'Category=' +  Category + '&' + 'propertytypeid=' +  typeid + '&' + 'minsize=' +  minsize + '&' +  'maxsize=' +  maxsize + '&' +  'Bedrooms=' +  bedrooms +  '&'  +  'minprice=' +  minprice + '&' +  'maxprice=' +  maxprice ;
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