@extends('layouts.welcome')
@section('content')
<section class="vmscard">
    <div class="container">
        <div class="row">
            <div class="head">
                @if (($services->type)==="Orthosis care")
                <h2 class="sm">{{ $services->serviceName }} description</h2>
                @endif                
                @if (($services->type)==="Prosthesis care")
                <h2 class="sm">{{ $services->serviceName }} description</h2>
                @endif
                @if (($services->type)==="Cosmetic solutions care")
                <h2 class="sm">{{ $services->serviceName }} description</h2>
                @endif
                @if (($services->type)==="Children care")
                <h2 class="sm">{{ $services->serviceName }} description</h2>
                @endif
            </div>
        </div>
    </div>

</section>
@php
  use Illuminate\Support\Facades\DB;
  $ourvideo = DB::table('service_video')->where('serviceID', $services->id)->get();
  $ourphotos = DB::table('service_photo')->where('serviceID', $services->id)->get();
  if  (count($ourphotos) > 0)
  {
    $no=$ourphotos{0}->id;
}
          
@endphp
<section class="co-service">
    <div class="container">
        <h2>{{$services->type}}</h2>
        <div class="co-hometo">
        </div>
        <div class="row">
            <div>
                <img  class="fulimg" src="\image\service\item\{{ $services->pic }}" alt="">
            </div>
            <div class="oneditails">
                <p>
                    {{ $services->description }}
                </p>
            </div>
            <div class="btncore">
                <div class="onebtn">
                    <a class="homeservice" href="/services">
                        Service home
                    </a>
                </div>
                <div class="onebtn">
                    @if (($services->type)==="Orthosis care")
    
                       <a class="homesubservice" href="{{ route('orthosishome') }}">
                        {{ $services->type}} home
                      </a>
                    @endif
                        @if (($services->type)==="Prosthesis care")
                        <a class="homesubservice" href="{{ route('prosthesishome') }}">
                            {{ $services->type}} home
                          </a>
                          @endif
                          @if (($services->type)==="Cosmetic solutions care")

                        <a class="homesubservice" href="{{ route('cosmetichome') }}">
                            {{ $services->type}} home
                          </a>
                          @endif
                          @if (($services->type)==="Children care")

                        <a class="homesubservice" href="{{ route('childrenhome') }}">
                            {{ $services->type}} home
                          </a>
                          @endif
                          @if (($services->type)==="Physio care")

                          <a class="homesubservice" href="{{ route('physiohome') }}">
                              {{ $services->type}} home
                            </a>
                            @endif
                </div>
            </div>
        </div>
    </div>
</section>
<section class="our-service">
    <div class="container">
        <h2 class="sm">{{ $services->serviceName }} our photos</h2>
        <div class="row">

            @if  (count($ourphotos) > 0)
            @foreach($ourphotos as $ourphoto)
            <div class="coreimg">
                <img src="\image\service\item\our\{{$ourphoto->photo}}" alt="" id="{{$ourphoto->id}}" onclick="displayIMG(this.id)">
            </div>
        @endforeach 
        @endif
            <div class="btncore">
                <div class="onebtn">
                    <a class="homeservice" href="/services">
                        Service home
                    </a>
                </div>
                <div class="onebtn">
                    @if (($services->type)==="Orthosis care")
     
                       <a class="homesubservice" href="{{ route('orthosishome') }}">
                        {{ $services->type}} home
                      </a>
                    @endif
                        @if (($services->type)==="Prosthesis care")

                        <a class="homesubservice" href="{{ route('prosthesishome') }}">
                            {{ $services->type}} home
                          </a>
                          @endif
                          @if (($services->type)==="Cosmetic solutions care")

                        <a class="homesubservice" href="{{ route('cosmetichome') }}">
                            {{ $services->type}} home
                          </a>
                          @endif
                          @if (($services->type)==="Children care")

                        <a class="homesubservice" href="{{ route('childrenhome') }}">
                            {{ $services->type}} home
                          </a>
                          @endif
                          @if (($services->type)==="Physio care")

                          <a class="homesubservice" href="{{ route('physiohome') }}">
                              {{ $services->type}} home
                            </a>
                            @endif
                </div>
            </div>
        </div>
    </div>
</section>
<section class="our-service">
    <div class="container">
        <h2 class="smt">Happy client with his perfect gait with {{ $services->serviceName }}</h2>
        <div class="row">
            @if  (count($ourvideo) > 0)
            @foreach($ourvideo as $ourvideot)
            <div class="corevideo">
                <iframe class="videoset" src="https://www.youtube.com/embed/{{$ourvideot->embed}}">
                </iframe>
            </div>
            @endforeach 
            @endif
   

            <div class="btncore">
                <div class="onebtn">
                    <a class="homeservice" href="/services">
                        Service home
                    </a>
                </div>

                <div class="onebtn">
                    @if (($services->type)==="Orthosis care")
     
                       <a class="homesubservice" href="{{ route('orthosishome') }}">
                        {{ $services->type}} home
                      </a>
                    @endif
                        @if (($services->type)==="Prosthesis care")

                        <a class="homesubservice" href="{{ route('prosthesishome') }}">
                            {{ $services->type}} home
                          </a>
                          @endif
                          @if (($services->type)==="Cosmetic solutions care")

                        <a class="homesubservice" href="{{ route('cosmetichome') }}">
                            {{ $services->type}} home
                          </a>
                          @endif
                          @if (($services->type)==="Children care")

                        <a class="homesubservice" href="{{ route('childrenhome') }}">
                            {{ $services->type}} home
                          </a>
                          @endif
                          @if (($services->type)==="Physio care")

                          <a class="homesubservice" href="{{ route('physiohome') }}">
                              {{ $services->type}} home
                            </a>
                            @endif
                </div>
            </div>
        </div>
    </div>
</section>
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
  </div>
@endsection