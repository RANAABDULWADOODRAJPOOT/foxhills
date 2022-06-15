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
			<p class="text-grey text-center my-3 ">Home > International </p>
			<h1  class="text-light text-center my-3">Properties</h1>
			
			<div class="row">
				@if(Agent::isMobile())
			<div style=" overflow-x: scroll;" class="row flex-row d-flex flex-nowrap horizontal-scroll">
				@else
				<div class="row w-100 mt-5">
					@endif

					@foreach($userproducts as $internationProduct)
					<div class="col-md-4  col-12 mb-3">
							<a href="{{ url('internation/'.$internationProduct->id ) }}">
						<div style="border:2px solid #222" >
							<img style="height: 250px;" class=" img-fluid w-100" src="<?php echo asset("assets/allimages/{$internationProduct->picture}")?>" >
							<div class="px-3">
								<h3 class="mt-3 mb-2 text-light">{!! $internationProduct->productname !!}</h3>
								<p class="mb-0 text-grey">{!! $internationProduct->Area !!}</p>
								<p class="mb-0 text-grey"><Span>{!! App\Models\PropertyType::getpropertytypeviaid($internationProduct->property_type_id) !!}  | {!! $internationProduct->Bedrooms !!} | {!! $internationProduct->length !!}</Span></p>
								<h4 class="mt-2 mb-3 text-light"> {!! number_format($internationProduct->Price, 3, ',', ','); !!}</h4>
							</div>
						</div>
					</a>
					</div>
					@endforeach

  
				</div>
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










		@include('includes.footer')
</div>
</section>




@endsection