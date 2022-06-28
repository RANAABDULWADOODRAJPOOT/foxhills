<section  style="background-color:#111" class="mb-center">
   <div  class="container pt-5 px-3">
      <div class="col-12 ">
         <h5 class="text-light text-center {!!  (Agent::isMobile()) ? 'mobilefont' : '' !!}">SIGN UP FOR OUR WEEKLY NEWSLETTER FOR MARKET UPDATES</h5>
         <div class="row {!!  (Agent::isMobile()) ? '' : 'justify-content-center ' !!}">
            <div class="col-md-6 col-6  my-3 p-0 ">
               <input  style="height: 30px; background-color:text-light;border: none; border:8px solid white" class="form-group w-100  mb-0" type="" name="">
            </div>
            <div class="col-md-2 col-2 my-3 p-0 ">
               <button style="background-color:black ; color: white; margin-top: 0px; padding-top:4px;border: 1px solid white;border-radius:0px;" class="btn btn-sm"><p style="font-size: 15px;margin-bottom:0px;">SIGNUP
                  &nbsp;<svg xmlns="http://www.w3.org/2000/svg" fill="white" width="12" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M438.6 278.6l-160 160C272.4 444.9 264.2 448 256 448s-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L338.8 288H32C14.33 288 .0016 273.7 .0016 256S14.33 224 32 224h306.8l-105.4-105.4c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160C451.1 245.9 451.1 266.1 438.6 278.6z"/></svg>
               </p></button>
            </div>
         </div>
      </div>
      <div class="col-12">
         <div class="row my-5">
          
            @foreach($allHeadings as $allHeading)
            @if($allHeading->location == 2)
            <div class="col-md-2  col-12  p-0">
               <a  href="{!! url($allHeading->heading.'/'.$allHeading->id) !!}"  class="text-light mb-5" style="font-size:18px;text-align:center;">{!! $allHeading->heading  !!}</a>
               <ul style="list-style-type: none; padding: 0px;">
                  @foreach($allHeading->properties as $type)
                  <li class="my-2">
                     <a href="{!! url($allHeading->id.'/'.$type->propertyType->id.'/'.'1') !!}" class="hover text-muted">{!! $type->productname !!}</a>
                  </li>
                  @endforeach
               </ul>
            </div>
            @else
            @continue
            @endif
            @endforeach
            
            
            
            <div class="col-md-3 col-12 p-0">
               <h5 class="text-light">Contact Us</h5>
               <p class="text-muted">Customer service +971 44 55 08 88</p>
               <div class="d-flex">
               <button style="background-color:black ; color: white; border: 1px solid white;  padding-top: 10px;" class="btn btn-sm mr-2">Email US
               {{-- <svg class="mx-2" fill="text-light" height="32" viewBox="0 -5 24 24" width="36" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 0h54v24H0z" fill="none"></path>
                  <path d="M12 4l-1.41 1.41L16.17 11h5v2h12.17l-5.58 5.59L12 20l8-8z"></path>
               </svg> --}}
            </button>
               <button style="background-color:black ; color: white;  border: 1px solid white; padding-top: 10px;top:0px !important;" class="btn btn-sm mt-0">Whatsapp
                  <svg style="top: 0px;" enable-background="new 0 0 24 24" width="30" height="30" id="Layer_1" version="1.1" viewBox="0 -6 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <g id="icon">
                     <circle cx="12" cy="12" fill="#6EBF3A" r="6"></circle>
                     <rect width="3" height="3" fill="#6EBF3A" x="7" y="14"></rect>
                     <path d="M17.0444,7.0608c-1.2327,-1.2337,-2.872,-1.9135,-4.6186,-1.9141c-3.5987,0,-6.5276,2.9278,-6.529,6.5265c-0.0005,1.1503,0.3002,2.2732,0.8715,3.263l-0.9263,3.3822l3.4611,-0.9076c0.9536,0.52,2.0273,0.794,3.12,0.7944h0.0027c3.5983,0,6.5275,-2.9281,6.5289,-6.5269C18.9556,9.9343,18.2771,8.2945,17.0444,7.0608L17.0444,7.0608zM12.426,17.1029h-0.0022c-0.9738,-0.0004,-1.9288,-0.2619,-2.762,-0.7562l-0.1982,-0.1176l-2.0539,0.5386l0.5482,-2.0019l-0.1291,-0.2053c-0.5432,-0.8637,-0.8301,-1.8621,-0.8297,-2.8871c0.0012,-2.9911,2.4356,-5.4246,5.4289,-5.4246c1.4494,0.0006,2.812,0.5656,3.8365,1.591s1.5885,2.3884,1.588,3.8379C17.8514,14.6692,15.417,17.1029,12.426,17.1029L12.426,17.1029zM15.4026,13.0399c-0.1632,-0.0816,-0.9652,-0.4762,-1.1147,-0.5306c-0.1495,-0.0544,-0.2583,-0.0816,-0.3671,0.0816c-0.1087,0.1633,-0.4214,0.5306,-0.5166,0.6394c-0.0952,0.1088,-0.1903,0.1225,-0.3534,0.0408c-0.1631,-0.0816,-0.6888,-0.2538,-1.3119,-0.8094c-0.4849,-0.4324,-0.8124,-0.9665,-0.9075,-1.1298c-0.0952,-0.1633,-0.0101,-0.2515,0.0715,-0.3328c0.0734,-0.0731,0.1631,-0.1905,0.2447,-0.2857c0.0816,-0.0952,0.1088,-0.1633,0.1631,-0.2721c0.0544,-0.1088,0.0272,-0.2041,-0.0136,-0.2857c-0.0408,-0.0816,-0.367,-0.8844,-0.503,-1.2109c-0.1324,-0.318,-0.2669,-0.275,-0.3671,-0.28c-0.0951,-0.0047,-0.2039,-0.0057,-0.3127,-0.0057c-0.1087,0,-0.2855,0.0408,-0.435,0.2041c-0.1495,0.1633,-0.571,0.5578,-0.571,1.3605s0.5845,1.5782,0.6661,1.687c0.0816,0.1088,1.1503,1.7561,2.7868,2.4625c0.3892,0.168,0.6931,0.2684,0.93,0.3435c0.3908,0.1241,0.7464,0.1066,1.0276,0.0646c0.3134,-0.0468,0.9652,-0.3945,1.1011,-0.7755c0.1359,-0.381,0.1359,-0.7075,0.0952,-0.7755C15.6745,13.1624,15.5657,13.1215,15.4026,13.0399L15.4026,13.0399z" fill="#FFFFFF"></path>
                  </g>
               </svg>
            </button>
            </div>
               <h5 class="text-light mt-md-5 mt-2">Follow Us</h5>
               <p class="social-container">
                  <a class="social-button facebook" title="Follow us on Facebook" href="https://www.facebook.com/luxhabitatsir" target="_blank" rel="noreferrer">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="88.428 12.828 107.543 207.085"><path d="M158.232 219.912v-94.461h31.707l4.747-36.813h-36.454V65.134c0-10.658 2.96-17.922 18.245-17.922l19.494-.009V14.278c-3.373-.447-14.944-1.449-28.406-1.449-28.106 0-47.348 17.155-47.348 48.661v27.149H88.428v36.813h31.788v94.461l38.016-.001z"></path></svg></a>
                  <a class="social-button twitter" title="Follow us on Twitter" href="https://twitter.com/luxhabitatsir" target="_blank" rel="noreferrer">
                  <svg aria-labelledby="simpleicons-twitter-icon" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="simpleicons-twitter-icon">Twitter icon</title><path d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555-2.005.959-3.127 1.184-.896-.959-2.173-1.559-3.591-1.559-2.717 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124C7.691 8.094 4.066 6.13 1.64 3.161c-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.189 1.394 4.768 2.209 7.557 2.209 9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63.961-.689 1.8-1.56 2.46-2.548l-.047-.02z"></path></svg></a>
                  <a class="social-button instagram" title="Follow us on Instagram" href="https://www.instagram.com/luxhabitatsir/" target="_blank" rel="noreferrer">
                  <svg aria-labelledby="simpleicons-instagram-icon" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="simpleicons-instagram-icon">Instagram icon</title><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"></path></svg></a>
                  <a class="social-button linkedin" title="Follow us on Linkedin" href="https://www.linkedin.com/company/luxhabitatsir/" target="_blank" rel="noreferrer">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512">
                  <path d="M29.675 177.275l92.784-1.157v303.831l-92.784 1.178v-303.851z"></path>
                  <path d="M200.141 177.275l88.658-1.126v38.646l0.021 10.947c26.255-25.744 53.32-45.2 96.563-45.2 51.016 0 100.362 21.381 100.362 91.034v208.435l-90 1.341v-159.232c0-35.103-8.796-57.733-50.719-57.733-36.935 0-52.398 6.615-52.398 55.214v160.399l-92.478 1.116v-303.841z"></path>
                  <path d="M127.836 81.449c0 28.051-22.74 50.79-50.79 50.79s-50.791-22.739-50.791-50.791c0-28.051 22.739-50.791 50.791-50.791 28.051 0 50.791 22.739 50.791 50.791z"></path>
                  </svg>
                  </a>
                  <a class="social-button youtube" title="Follow us on Youtube" href="https://www.youtube.com/c/LuxhabitatSotheby'sInternationalRealty" target="_blank" rel="noreferrer">
                  <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title>YouTube icon</title><path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"></path></svg></a>
                  <a class="social-button pinterest" title="Follow us on Youtube" href="https://www.pinterest.com/luxhabitatsir/" target="_blank" rel="noreferrer">
                  <svg aria-labelledby="simpleicons-pinterest-icon" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="simpleicons-pinterest-icon">Pinterest icon</title><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.354-.629-2.758-1.379l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.607 0 11.985-5.365 11.985-11.987C23.97 5.39 18.592.026 11.985.026L12.017 0z"></path></svg></a>
                  </p>
               
            </div>
         </div>
      </div>

      <div id="legal-information" class="pw100 left text-white">
         <div class="f12 lh16 brd-top cf-group mrg-bottom-10 mrg-top-20 pdg-10">
         <div class="column-66 left text-left pdg-top-10">
         © 2022 LUXHABITAT®
         <span class="footer-separator break"></span>
         <a href="{!! url('terms-conditions') !!}" class="hover">Terms Of Use</a>
         <span class="footer-separator"></span>
         <a href="{!! url('privacy-policy') !!}" class="hover">Privacy Policy</a>
         <span class="footer-separator"></span>
         <a href="https://www.luxhabitat.ae/sitemap/" class="hover">Sitemap</a>
         <span class="footer-separator"></span>
         <a href="https://www.luxhabitat.ae/portfolio/" class="hover">Portfolio</a>
         <span class="footer-separator"></span>
         <a href="{!! url('cookies') !!}" class="hover">Cookies</a>
         <div class="desktop mrg-top-10" style="width:650px">LUXHABITAT® is a registered trademark. LUXHABITAT Sotheby’s website, LUXHABITAT.AE is operated by LXT Real Estate Brokers LLC as a platform for the publication of real estate properties from LUXHABITAT Real Estate LLC (ORN 12521)</div>
         </div>
         <div class="column-33 right pdg-top-10">
         <form id="settings" method="POST" action="#">
         <div class="settings-menu">
         <div class="size" style="width:120px;">
         {{-- <div class="form-group pw100">
         <label for="settings-sq-ft" class="btn compact pw50 selected">SQ FT</label>
         <label for="settings-sq-m" class="btn compact pw50">SQ M</label>
         </div> --}}
         <input type="radio" id="settings-sq-ft" name="size" value="sq ft" class="hidden" checked="">
         <input type="radio" id="settings-sq-m" name="size" value="sq m" class="hidden">
         </div>
         <select id="settings-currency" name="currency" class="compact" style="width:80px; margin-left:20px;">
         <option value="3" selected="">AED</option>
         <option value="4">CN¥</option>
         <option value="2">EUR</option>
         <option value="5">GBP</option>
         <option value="6">RUB</option>
         <option value="1">USD</option>
         </select>
         </div>
         </form>
         </div>
         </div>
         </div>
   </div>
</section>