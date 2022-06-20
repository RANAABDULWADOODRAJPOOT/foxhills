@extends('lux_habitate')
@section('content')


<main id="content" class="pw100" style="display:table;">
    <div class="wrapper">
    <section id="agata-correia" class="cf-group">
    <aside class="column-33 left mrg-top-20 mrg-ignore-mobile">
    <div class="pdg-right-30 pdg-ignore-mobile">
    <img src="{{ asset('assets/allimages/'.$agentdetails->picture) }}" class="full-width-responsive" alt="Picture of Senior Global Property Consultant" width="350" height="350">
    <div class="tablet">
    <h2 class="f16 normalcase white mrg-top-20 mrg-bottom-5">Languages</h2>
    <p class="georgia f16 lh24">{!! $agentdetails->Language !!}</p>
    <h2 class="f16 normalcase white mrg-top-20 mrg-bottom-5">Real estate experience</h2>
    <p class="georgia f16 lh24">
    {!! $agentdetails->experience !!} years<br>
    </p>
    </div>
    </div>
    </aside>
    <div class="column-66 right cf-group">
    <div class="pdg-left-30">
    <div class="pdg-right-30 pdg-ignore-tablet">
    <article class="mrg-top-20">
    <header class="mrg-bottom-30">
    <h1 class="tw mrg-auto text-left" style="padding:0">{!! $agentdetails->agentname !!}</h1>
    <p class="f16 lh24">{!! $agentdetails->Desigination !!}, License No.{!! $agentdetails->Licence !!}</p>
    </header>
    <div class="f18 lh28">
    {!! $agentdetails->description !!}
    <br> 

	<div class="pdg-right-10 mrg-top-10 mrg-bottom-10 tablet left pw100">
        <a class="btn btn-white open-enquiry request" style="width:198px;">Contact agent</a>
        </div>

</div>
    </article>
    </div>
    </div>
    </div>
    </section>
    <div class="pw100 left mrg-bottom-30"></div>
    </div> </main>






    <div  class="modal myModalAll" tabindex="-1" role="dialog">
        <div class="col-md-8 offset-md-2 col-12 mt-5" role="document">
            <div style="background-color: black; border: 5px solid #222;" class="modal-content">
                <div class="modal-body p-4">
                    <div class="col-12">
                        <h3 class="text-light">{!! $agentdetails->agentname !!}</h3>
                        <p class="text-grey d-md-block d-none">{!!$agentdetails->description!!}
                        </p>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-12 mb-3">	

                            <img src="<?php echo asset("assets/allimages/".$agentdetails->picture)?>" alt="Brand New Designer Villa on Palm Jumeirah image 1" class="full-width-responsive" width="120" height="120" style="max-height:250px;max-width:250px;margin:auto;">
                        </div>
                        <div class="col-md-6 col-12">
                            <form method="POST" action="{{url('sale/save-request-from-user')}}" enctype="multipart/form-data">
                                @csrf
                                
                                <input  style="height: 40px;border: none; " class="form-group w-100 " type="text" name="name" placeholder="Full Name" required>
                                <input  style="height: 40px;border: none; " class="form-group w-100 " type="email" name="email" placeholder="Email" required>
                                <input  style="height: 40px;border: none; " class="form-group w-100 " type="tel" name="phone" placeholder="Phone Number" id="mobile-number" required>
                                <input  style="height: 40px;border: none; " class="form-group w-100 " type="text" name="description" placeholder="Inquiry message" required>
                                {{-- @if(str_contains( App\Models\AvailableProperty::getPropertyType($userProducts->Category) ,"Sale"))
                               <input  style="height: 40px;border: none; " class="form-group w-100 " type="hidden" name="user_request_type" value="buy">
                                @else
                               <input  style="height: 40px;border: none; " class="form-group w-100 " type="hidden" name="user_request_type"  value="{!! App\Models\AvailableProperty::getPropertyType($userProducts->Category) !!}">
                                @endif --}}
                                
                                <div class="col-12 text-center m-0 p-0">
                                    <button style="background-color:white; border: 1px solid white;  color: black  ;" class="btn btn-lg text-center btn-block mt-3">Submit Enquiry</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>




    <script type="text/javascript">
        var count = 0; 
          $( ".request" ).click(function() {
              $(".myModalAll").modal("toggle")
          });

          $( ".viewcontrol" ).click(function() {

              if(count == 0){
              $("#property-descriptionone").addClass("d-none");
              $("#property-descriptiontwo").removeClass("d-none");
              count = 1; 
          }
          else{
              $("#property-descriptionone").removeClass("d-none");
              $("#property-descriptiontwo").addClass("d-none");
              count = 0; 
          }

          });

          </script>


    
@include('includes.footer')
    @endsection

  


    