@extends('lux_habitate')
@section('content')
@if( ! Agent::isMobile())
@include('partials.homeScreenFilter')
@endif





<main id="content" class="pw100" style="display:table;">
	<ol id="breadcrumbs" class="row-li">
		<li>
			<a href="/">Home</a>
		</li>
		<li>
			<a href="/">Team </a>
		</li>

	</ol>
	<div class="wrapper">
		<article id="property-10382">
			<header class="brd-bottom">
				<h1 id="property-title" class="tw mrg-bottom-20">Our Team</h1>
				<p class="text-grey text-center">Meet our team of real estate agents and marketing specialists</p>
			</header>
		</article>
	</div>


	


	<section id="listings" class="wrapper">
	<div class="home-section cf-group mrg-bottom-60">
	<div class="cf-group relative">
	<div class="tab active">
	<div class="mobile-slider">
	<div class="list inner">
	    @foreach($allagents as $allagent)
	<div class="column-33 property">
		<article id="development_1044" class="list-item no-brd mrg-auto">
			<a href="{{ url('agentdetails/'.$allagent->id ) }}" class="cf-group">
				<div class="image  img-override no-brd">
					<img src="{{ asset('assets/allimages/'.$allagent->picture) }}" class="left brd full-width-responsive" loading="lazy" width="150" height="150">
				</div>
				<div class="pdg-top-2 pdg-bottom-20">
					<span class="override animated text-left pdg-20">
						<h2 style="font-size: 16px; margin-top: -6px;text-align:center;" class="white font-weight-bold">{!! substr($allagent->agentname, 0, 25) !!}</h2>
						<p style="margin-top: -2px;font-size: 15px; text-align:center;" class="text-grey f16 lh20">{!! $allagent->Desigination !!}</p>
					</span>
				</div>
			</a>
		</article>
	</div>
	@endforeach
	   
	
	</div>
	</div>
	</div>
	<div class="tab">
	<div class="mobile-slider">
	<div class="list inner">
	
	</div>
	</div>
	</div>
	</div>
	<div class="brd-bottom mrg-top-10"></div>
	</div>
	</section>

</main>

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


			


				@include('includes.footer')

		@endsection