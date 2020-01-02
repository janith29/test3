@extends('layouts.welcome')
@section('content')
  
<section class="vmscard">
    <div class="container">
        <div class="row">
            <div class="head">
                <h2>Service</h2>
            </div>
        </div>
    </div>
  
  </section>
  @if (($types)==="Orthosis care")
  <section class="co-service">
    <div class="container">
        <h2>Orthosis care</h2>

        <div class="row">
  
  
              @foreach($services as $service)
              @if (($service->type)==="orthosis")
            <div class="oneservice">
                <div class="imgservice">
                    <a href="{{ route('services.orthosis.show',[$service->id]) }}"> <img src="\image\service\item\{{ $service->pic }}" alt=""></a>
                </div>
                <div class="details">
                    <h4>
                          {{ $service->serviceName }}
                    </h4>
                    <a class="showmore" href="{{ route('services.orthosis.show',[$service->id]) }}"><i class="fa fa-eye"> Show more</i></a>
                </div>
            </div>
            @endif
            @endforeach 
            <div class="btncore">
                <div class="onebtn">
                    <a class="homeservice" href="/services">
                        Service home
                    </a>
                </div>
                <div class="onebtn">
                    @if (($types)==="Orthosis care")
     
                       <a class="homesubservice" href="{{ route('orthosishome') }}">
                        {{ $types}} home
                      </a>
                    @endif
                        @if (($types)==="Prosthesis care")

                        <a class="homesubservice" href="{{ route('prosthesishome') }}">
                            {{$types}} home
                          </a>
                          @endif
                          @if (($types)==="Cosmetic solutions care")

                        <a class="homesubservice" href="{{ route('cosmetichome') }}">
                            {{ $types}} home
                          </a>
                          @endif
                          @if (($types)==="Children care")

                        <a class="homesubservice" href="{{ route('childrenhome') }}">
                            {{ $types}} home
                          </a>
                          @endif
                </div>
            </div>
        </div>
    </div>
  </section>

  @endif
  @if (($types)==="Prosthesis care")
  <section class="co-service">
    <div class="container">
        <h2>Prostheses care</h2>
    
        <div class="row">
  
  
              @foreach($services as $service)
              @if (($service->type)==="prosthesis")
            <div class="oneservice">
                <div class="imgservice">
                    <a href="{{ route('services.orthosis.show',[$service->id]) }}"> <img src="\image\service\item\{{ $service->pic }}" alt=""></a>
                </div>
                <div class="details">
                    <h4>
                          {{ $service->serviceName }}
                    </h4>
                    <a class="showmore" href="{{ route('services.orthosis.show',[$service->id]) }}"><i class="fa fa-eye"> Show more</i></a>
                </div>
            </div>
            @endif
            @endforeach 
            <div class="btncore">
                <div class="onebtn">
                    <a class="homeservice" href="/services">
                        Service home
                    </a>
                </div>
                <div class="onebtn">
                    @if (($types)==="Orthosis care")
     
                       <a class="homesubservice" href="{{ route('orthosishome') }}">
                        {{$types}} home
                      </a>
                    @endif
                        @if (($types)==="Prosthesis care")

                        <a class="homesubservice" href="{{ route('prosthesishome') }}">
                            {{ $types}} home
                          </a>
                          @endif
                          @if (($types)==="Cosmetic solutions care")

                        <a class="homesubservice" href="{{ route('cosmetichome') }}">
                            {{ $types}} home
                          </a>
                          @endif
                          @if (($types)==="Children care")

                        <a class="homesubservice" href="{{ route('childrenhome') }}">
                            {{ $types}} home
                          </a>
                          @endif
                </div>
            </div>
        </div>
    </div>
  </section>
  @endif
  @if (($types)==="Cosmetic solutions care")
  <section class="co-service">
    <div class="container">
        <h2>Cosmetic solutions care</h2>
    
        <div class="row">
              @foreach($services as $service)
              @if (($service->type)==="cosmetic")
            <div class="oneservice">
                <div class="imgservice">
                    <a href="{{ route('services.cosmetic.show',[$service->id]) }}"> <img src="\image\service\item\{{ $service->pic }}" alt=""></a>
                </div>
                <div class="details">
                    <h4>
                          {{ $service->serviceName }}
                    </h4>
                    <a class="showmore" href="{{ route('services.cosmetic.show',[$service->id]) }}"><i class="fa fa-eye"> Show more</i></a>
                </div>
            </div>
            @endif
            @endforeach 
            <div class="btncore">
                <div class="onebtn">
                    <a class="homeservice" href="/services">
                        Service home
                    </a>
                </div>
                <div class="onebtn">
                    @if (($types)==="Orthosis care")
     
                       <a class="homesubservice" href="{{ route('orthosishome') }}">
                        {{ $types}} home
                      </a>
                    @endif
                        @if (($types)==="Prosthesis care")

                        <a class="homesubservice" href="{{ route('prosthesishome') }}">
                            {{ $types}} home
                          </a>
                          @endif
                          @if (($types)==="Cosmetic solutions care")

                        <a class="homesubservice" href="{{ route('cosmetichome') }}">
                            {{ $types}} home
                          </a>
                          @endif
                          @if (($types)==="Children care")

                        <a class="homesubservice" href="{{ route('childrenhome') }}">
                            {{ $types}} home
                          </a>
                          @endif 
                         
                </div>
            </div>
        </div>
    </div>
  </section>
  @endif
  @if (($types)==="Children care")
  <section class="co-service">
    <div class="container">
        <h2>Children care</h2>
        <div class="co-hometo">
        <a  href="{{ route('childrenhome') }}"><i class="fa fa-eye"> Show Orthosis care</i></a>
    </div>
        <div class="row">
              @foreach($services as $service)
              @if (($service->type)==="children")
            <div class="oneservice">
                <div class="imgservice">
                    <a href="{{ route('services.children.show',[$service->id]) }}"> <img src="\image\service\item\{{ $service->pic }}" alt=""></a>
                </div>
                <div class="details">
                    <h4>
                          {{ $service->serviceName }}
                    </h4>
                    <a class="showmore" href="{{ route('services.children.show',[$service->id]) }}"><i class="fa fa-eye"> Show more</i></a>
                </div>
            </div>
            @endif
            @endforeach 
            <div class="btncore">
                <div class="onebtn">
                    <a class="homeservice" href="/services">
                        Service home
                    </a>
                </div>
                <div class="onebtn">
                    @if (($types)==="Orthosis care")
     
                       <a class="homesubservice" href="{{ route('orthosishome') }}">
                        {{ $types}} home
                      </a>
                    @endif
                        @if (($types)==="Prosthesis care")

                        <a class="homesubservice" href="{{ route('prosthesishome') }}">
                            {{ $types}} home
                          </a>
                          @endif
                          @if (($types)==="Cosmetic solutions care")

                        <a class="homesubservice" href="{{ route('cosmetichome') }}">
                            {{ $types}} home
                          </a>
                          @endif
                          @if (($types)==="Children care")

                        <a class="homesubservice" href="{{ route('childrenhome') }}">
                            {{ $types}} home
                          </a>
                          @endif
                </div>
            </div>
        </div>
    </div>
  </section>
  @endif
  @if (($types)==="Physio care")
  <section class="co-service">
    <div class="container">
    <h2>{{$types}}</h2>
        <div class="co-hometo">
        <a  href="{{ route('physiohome') }}"><i class="fa fa-eye"> Show Physio care</i></a>
    </div>
        <div class="row">
              @foreach($services as $service)
              @if (($service->type)==="physio")
            <div class="oneservice">
                <div class="imgservice">
                    <a href="{{ route('services.physio.show',[$service->id]) }}"> <img src="\image\service\item\{{ $service->pic }}" alt=""></a>
                </div>
                <div class="details">
                    <h4>
                          {{ $service->serviceName }}
                    </h4>
                    <a class="showmore" href="{{ route('services.physio.show',[$service->id]) }}"><i class="fa fa-eye"> Show more</i></a>
                </div>
            </div>
            @endif
            @endforeach 
            <div class="btncore">
                <div class="onebtn">
                    <a class="homeservice" href="/services">
                        Service home
                    </a>
                </div>
                <div class="onebtn">
                    @if (($types)==="Orthosis care")
     
                       <a class="homesubservice" href="{{ route('orthosishome') }}">
                        {{ $types}} home
                      </a>
                    @endif
                        @if (($types)==="Prosthesis care")

                        <a class="homesubservice" href="{{ route('prosthesishome') }}">
                            {{ $types}} home
                          </a>
                          @endif
                          @if (($types)==="Cosmetic solutions care")

                        <a class="homesubservice" href="{{ route('cosmetichome') }}">
                            {{ $types}} home
                          </a>
                          @endif
                          @if (($types)==="Children care")

                        <a class="homesubservice" href="{{ route('childrenhome') }}">
                            {{ $types}} home
                          </a>
                          @endif
                          @if (($types)==="Physio care")

                          <a class="homesubservice" href="{{ route('physiohome') }}">
                              {{ $types}} home
                            </a>
                            @endif
                </div>
            </div>
        </div>
    </div>
  </section>
  @endif
@endsection