<div style="background-color:#222" class="d-none d-sm-none d-md-flex ">
<div class="row wrapper m-auto">
	<div class="col-1 p-0" style="max-width: 30px;">
		<svg style=" margin-top: 12px;" fill="#000000" height="21" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
			<path fill="#999"  d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
			<path d="M0 0h24v24H0z" fill="none"></path>
		</svg>
	</div>
	<div class="col-6 p-0" style="min-width: 55%">
		<input  style="height: 43px;background-color:#222;border: none; " class="form-group w-100 mb-0" type="text" name="" placeholder="Enter any area or development " id="search">
	</div>
	<div style="margin-top: 4px !important;justify-content:end;" id="filterbarhover"  class="col-5 d-flex m-0 p-0">

 @php ($allheadings = App\Models\page::getallheadings())
 {{-- <div id="Firstdropdown" class="dropdown">
	
 	<button id="typeButton" style="background-color: #222;border:none; color:#999;font-size: 12px;padding-left:7px !important" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Category
		<i class="fa-solid fa-angle-down"></i>
 	</button>
 	<div style="background-color:black; min-width: 12rem;" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
 		<input  type="hidden"  class="defaultcategory" type="checkbox" value="0" style="margin-top: 0.5rem">
 		@foreach($allheadings as $allheading) 
 		<div class="d-flex px-2 my-2">
 			<input id="type_{!! $allheading->id !!}" style="margin-top:-0.5rem;"  class="Category" type="checkbox"  value="{!! $allheading->id !!}" data-property-name="{!! $allheading->title !!}">
 			<label for="type_{!! $allheading->id !!}"   style="font-size:13px;line-height:0px !important;" class="text-muted-filter ml-3 font-size-sm" >{!! $allheading->heading !!}</label>
 		</div>
 		@endforeach
 	</div>
 </div> --}}

        
            @php ($types = App\Models\PropertyType::getPropertyTypes())
			<div id="Firstdropdown" class="dropdown">
			<button id="typeButton" style="background-color: #222;border:none; color:#999; font-size: 12px;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Types
			</button>
			<div  style="background-color:black;  min-width: 12rem;"   class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <input  type="hidden"  class="mt-1 defaultproperty" type="checkbox" value="0">
				@foreach($types as $type)
				<div class="d-flex px-3 my-2">
				 <input id="types_{!! $type->id !!}" style="margin-top:0rem;"  class="typename" type="checkbox"  value="{!! $type->id !!}" data-property-name="{!! $type->title !!}">
				 <label for="types_{!! $type->id !!}"   style="font-size:13px;line-height:0px;" class="text-muted-filter ml-3 font-size-sm" >{!! $type->title !!}</label>
				</div>
				@endforeach

			</div>
		</div>

		

		 
		
		<div class="subnav">
			<button  id="sizemenu" style="background-color: #222;border:none; color:#999; margin-top:5px; font-size: 12px;width:60px;"  class="subnavbtn dropdown-toggle">SIZE <i class="fa-solid fa-angle-down"></i></button>
			<div id="sizebar"   class="subnav-contentone d-none">
				<div class="d-flex p-3">
					<select style="background-color:black;" class="form-select mx-2 minvalue" aria-label="Default select example">
						<option id="minsizeone" value="0" selected>Min Size</option>
						<option class="secondindex" value="1000">1,000 sq ft</option>
						<option value="2000">2,000 sq ft</option>
						<option value="3000">3,000 sq ft</option>
						<option value="4000">4,000 sq ft</option>
						<option value="5000">5,000 sq ft</option>
						<option value="6000">6,000 sq ft</option>
						<option value="7000">7,000 sq ft</option>
						<option value="8000">8,000 sq ft</option>
						<option value="9000">9,000 sq ft</option>
						<option value="10000">10,000+ sq ft</option>
						</select>
					<select style="background-color:black;" class="form-select mx-2 maxvalue" aria-label="Default select example">
						<option id="maxnsizeone" value="0"   selected>Max Size</option>
						<option value="1000">1,000 sq ft</option>
						<option value="2000">2,000 sq ft</option>
						<option value="3000">3,000 sq ft</option>
						<option value="4000">4,000 sq ft</option>
						<option value="5000">5,000 sq ft</option>
						<option value="6000">6,000 sq ft</option>
						<option value="7000">7,000 sq ft</option>
						<option value="8000">8,000 sq ft</option>
						<option value="9000">9,000 sq ft</option>
						<option value="10000">10,000+ sq ft</option>
					</select>
				</div>
			</div>
		</div>
        
        
		 @php ($allpropertiesbedrooms= App\Models\AvailableProperty::getallbedrooms())
		
            <div id="Firstdropdown" class="dropdown">
			<button id="typeButton" style="background-color: #222;border:none;color:#999; font-size: 12px;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				BEDS			</button>
			<div  style="background-color:black;  min-width: 12rem;"  class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<input  type="hidden"  class="mt-1 defaultBedrooms" type="checkbox" value="0">
				@for($i=0;$i<4;$i++)
				<div class="d-flex px-3 my-2">
					<input id="typess_{!! $allpropertiesbedrooms[$i] !!}"  style="margin-top:0;"  class="Bedrooms" type="checkbox" value="{!! $allpropertiesbedrooms[$i] !!}">
					 <label for="typess_{!! $allpropertiesbedrooms[$i] !!}"  style="line-height:0px;font-size:13px;" class="text-muted-filter ml-3 font-size-sm" >{!! $allpropertiesbedrooms[$i] !!} bedrooms</label>
				</div>
				@endfor

			</div>
		</div>




        
		<div class="subnav">
			<button id="pricemenu" style="background-color: #222;border:none; color:#999; margin-top:5px;font-size: 12px; width:60px;"  class="subnavbtn dropdown-toggle">PRICE <i class="fa-solid fa-angle-down"></i></button>
			<div id="pricebar" class="subnav-contenttwo d-none">
				<div class="d-flex px-3 py-3">
					<select  style="background-color:black;" class="form-select mx-2 minprice" aria-label="Default select example">
						<option  id="minpriceone" value="0"  selected>Min price</option>
						<option class="index" value="1000000">1,000,000 AED</option>
						<option value="2000000">2,000,000 AED</option>
						<option value="3000000">3,000,000 AED</option>
						<option value="4000000">4,000,000 AED</option>
						<option value="5000000">5,000,000 AED</option>
						<option value="6000000">6,000,000 AED</option>
						<option value="7000000">7,000,000 AED</option>
						<option value="8000000">8,000,000 AED</option>
						<option value="9000000">9,000,000 AED</option>
						<option value="10000000">10,000,000 AED</option>
						<option value="15000000">15,000,000 AED</option>
						<option value="20000000">20,000,000 AED</option>
						<option value="25000000">25,000,000 AED</option>
						<option value="30000000">30,000,000 AED</option>
						<option value="35000000">35,000,000 AED</option>
						<option value="40000000">40,000,000 AED</option>
						<option value="45000000">45,000,000 AED</option>
						<option value="50000000">50,000,000+ AED</option>
					</select>
					<select  style="background-color:black;" class="form-select mx-2 maxprice" aria-label="Default select example">
						<option id="maxpriceone" value="0"  selected>max Pice</option>
						<option value="1000000">1,000,000 AED</option>
						<option value="2000000">2,000,000 AED</option>
						<option value="3000000">3,000,000 AED</option>
						<option value="4000000">4,000,000 AED</option>
						<option value="5000000">5,000,000 AED</option>
						<option value="6000000">6,000,000 AED</option>
						<option value="7000000">7,000,000 AED</option>
						<option value="8000000">8,000,000 AED</option>
						<option value="9000000">9,000,000 AED</option>
						<option value="10000000">10,000,000 AED</option>
						<option value="15000000">15,000,000 AED</option>
						<option value="20000000">20,000,000 AED</option>
						<option value="25000000">25,000,000 AED</option>
						<option value="30000000">30,000,000 AED</option>
						<option value="35000000">35,000,000 AED</option>
						<option value="40000000">40,000,000 AED</option>
						<option value="45000000">45,000,000 AED</option>
						<option value="50000000">50,000,000+ AED</option>
					</select>
				</div>
			</div>
		</div>


		
             
		
		
		

		





	</div>
</div>
</div>

<script type="text/javascript">
	$( document ).ready(function() {
		$( "#sizemenu" ).hover(function() {
			$( "#sizebar" ).removeClass("d-none");
			$( "#pricebar" ).addClass("d-none");

		});
		$( "#pricemenu" ).hover(function() {
			$( "#pricebar" ).removeClass("d-none");
			$( "#sizebar" ).addClass("d-none");
		});
		$( "#filterbarhover" ).hover(function() {
			if ($('#filterbarhover:hover').length = 0) {
			}
			else{
				$( "#pricebar" ).addClass("d-none");
				$( "#sizebar" ).addClass("d-none");
			}
		});
		$('input[type="checkbox"]').on('change', function() {
			$('input[type="checkbox"]').not(this).prop('checked', false);
		});

		$('input[type="text"]').on('keydown', function(event){
			if (event.key === "Enter") {
				var pathname = window.location.origin
				var  redirecturl = pathname  + '/'  +  'filter' + '/' + event.target.value;
				window.location.href = redirecturl;
				// alert(pathname);
       
    }
			
		});

	});
</script>