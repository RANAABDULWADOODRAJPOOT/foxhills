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
    <br> </div>
    </article>
    </div>
    </div>
    </div>
    </section>
    <div class="pw100 left mrg-bottom-30"></div>
    </div> </main>



    

    @endsection


    