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
		<div class="col-md-10 col-12 mt-5">
			{{-- <p class="text-grey text-center my-3 ">Home > The Journal</p> --}}
			<h1  class="text-light text-center my-3">{!! $Journals->journal_title !!}</h1>
			{{-- <p class="mb-md-0 text-muted text-center">{!! $Journals->journal_type !!}</p> --}}
			<hr class="text-light">
			@if(Agent::isMobile())
			<div style=" overflow-x: scroll;" class="row flex-row d-flex flex-nowrap horizontal-scroll">
				@else
					<div class="col-12 p-0">
				@endif
			
		</div>

			<div style="border-bottom: 1px solid #222;" class="row pb-5 pt-4">
				<div class="col-md-8 offset-md-2 col-12 p-0">
					<img style="height:500px;" class=" img-fluid w-100" src="<?php echo asset("assets/allimages/{$Journals->picture}")?>" >
					
				    <p class="my-4 text-light">{!! str_replace('"', '', $Journals->description); !!}</p>
				</div>
			</div>
			
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

	
	
</div>
</section>

@include('includes.footer')


@endsection