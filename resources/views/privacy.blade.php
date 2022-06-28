@extends('lux_habitate')
@section('content')
@if( ! Agent::isMobile())
@include('partials.homeScreenFilter')
@endif




<article id="privacy-policy" class="block container">
    <header class="text-center mrg-bottom-20 brd-bottom">
    <h1 class="tw mrg-bottom mt-5">Privacy Policy</h1>
    </header>
    <div class="pdg-left-10 pdg-bottom-20 pdg-right-10 f16 lh24">
    <p>LXT REAL ESTATE BROKERS, trading as LUXHABITAT takes your privacy seriously. We make it a priority to secure and protect the confidentiality of the personally identifiable information that you provide to us. This policy explains the type of personal information we gather when you use www.luxhabitat.ae or our affiliated websites (collectively, the “Site”) and when you provide us information by other means, including by email and telephone.</p>
    <h2 class="tw">Information We Collect</h2>
    <p>LUXHABITAT collects non-personally identifiable information about visitors to the Site such as aggregate information on what pages are accessed or visited. We use this information to continually improve the online experience we provide Site visitors. We use cookies to store visitors’ preferences, record session information (for instance, properties that visitors add to their “My Favourites” section) and record past activity at a site in order to provide better service when visitors return to the Site.We also collect personally identifiable information that is specifically volunteered to us by email, by telephone or by those visiting the Site online, including request and contact information and survey information.</p>
    <h2 class="tw">Use of the Information We Collect</h2>
    <p>The information we collect is used to improve the Site and to contact those who have requested information concerning our products and services and, as needed, to carry out the purchase of products and services. We will only send you updates, offerings or product information by email or mail if you have if you have provided your email or mailing address to us.</p>
    <h2 class="tw">You May “Opt Out” of Receiving Future Offerings</h2>
    <p>Should you wish to opt out of receiving promotions, offerings or communications from LUXHABITAT in the future, please let us know by clicking on the "unsubscribe" link within the e-mail that you received from us.</p>
    <h2 class="tw">Third-Party Web Beacons</h2>
    <p>We use third-party web beacons from Google to help analyze where visitors go and what they do while visiting the Site. Google may also use anonymous information about your visits to the Site in order to improve its products and services and provide advertisements about goods and services of interest to you. If you would like more information about this practice and to know your choices about not having this information used by Google, <a href="http://www.google.com/analytics/learn/privacy.html" target="_blank" class="hover underline">click here</a>.</p>
    <h2 class="tw">Sharing of Information</h2>
    <p>We do not sell or rent your personal information to anyone. LUXHABITAT will only share your personally identifiable information with our affiliates and authorized service providers that perform certain services or functions on our behalf. We reserve the right to disclose your personally identifiable information as required by law and when we believe that disclosure is necessary to protect our rights and/or to comply with a judicial proceeding, court order or legal process involving LUXHABITAT or the Site.</p>
    <h2 class="tw">Updates to our Policy</h2>
    <p class="georgia dark-grey f14 mb-g ml-g mr-g lh13">From time to time, we may use customer information for new, unanticipated uses not previously disclosed in our privacy notice. If our information practices change at some time in the future we will post the policy changes to the Site to notify you of these changes and provide you with the ability to opt out of these new uses. If you are concerned about how your information is used, you should check back at the Site periodically.</p>
    <h2 class="tw">Updating your Information</h2>
    <p class="georgia dark-grey f14 mb-g ml-g mr-g lh13">We offer visitors the ability to have inaccuracies corrected in contact information. Consumers can have this information easily updated accesing to the personal account area or by writing to us.</p>
    <h2 class="tw">External Links</h2>
    <p class="georgia dark-grey f14 mb-g ml-g mr-g lh13">The Site may provide links to external websites maintained by individuals or organizations external to LUXHABITAT. Once you access information that links you to another website, you are subject to the privacy policy of these external sites.</p>
    <h2 class="tw">We Protect your Information</h2>
    <p>We value your privacy and we have appropriate security measures in place in our physical facilities to protect against the loss, misuse or alteration of information that we have collected from you at the Site.</p>
    <p>Revised 10 January 1, 2009. © 2009 LUXHABITAT. All rights reserved.</p>
    <h2 class="tw">GDPR compliance</h2>
    <p>Following the new EU General Data Protection Regulation (GDPR) that takes effect on May 25, 2018. We may need to collect and process personal information in order to provide the services to you or because we are legally required to do so. If you do not provide the information that we request, we may not be able to provide you with the services. We may use the personal information for our legitimate business interests, including those listed above.</p>
    <p>We do not knowingly permit children in the EEA under age 16 to register for any content, product or service. We do not knowingly collect, use or disclose personal information about users under age 16, except as permitted by law.</p>
    <p>We keep your personal information for as long as needed or permitted in light of the purpose for which it was obtained. The criteria used to determine our retention periods include (i) for as long as we have an ongoing relationship with you and provide the Services to you; (ii) as required by a legal obligation to which we are subject; or (iii) as advisable in light of our legal position (such as in regard of applicable statutes of limitations, litigation, or regulatory investigations).</p>
    <p>If you would like to receive an electronic copy of your Personal Information or for any questions about this privacy policy, you may contact us at <a href="mailto:marketing@luxhabitat.ae">marketing@luxhabitat.ae</a>.</p>
    </div>
    </article>







<script type="text/javascript">
	$( "#saleRequest" ).click(function() {
		$(".myModalsale").modal("toggle")
	});
</script>



		@include('includes.footer')


		<script type="text/javascript">
     

			$(".faq-item").click(function(){
				$(".faq-item").removeClass("active");
				$(this).addClass("active");
				
			});
		
		
		
			$( document ).ready(function() {
		
				$( ".request" ).click(function() {
					$(".myModalAll").modal("toggle")
				});
		
		
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




@endsection