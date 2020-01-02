@extends('patient.layouts.patient')
@section('content')
    <div class="row title-section">
        <div class="col-12 col-md-8">
        @section('title', "Service Management")
        </div>
        
    </div>
    <div class="row">
        @if ($services->isEmpty())
        <div class="alert alert-danger" role="alert">
                <p>Not have Data in service table</p>
        </div>
        @else
        <div class="container">
                <br>
                <div class="col-12 panel panel-primary">
                            
                    {{-- <div class="panel-body"><p style="text-align:center;"><img src="img/core-img/artificial.png" class="center" width="800" height="420"></p></div> --}}
                    <div class="panel-heading"><p style="text-align:center;"> <img src="\img\icons\orthosis.png" width="75px" height="75px"></p><h4 align="center">Orthosis care</h4>
                </div>
                </div>
        @foreach($services as $service)

        @if (($service->type)==="orthosis")
        <div class="col-12 col-sm-4 col-md-3 col-lg-3 text-center">
                <div class="panel panel-success ">
                    <div class="panel-heading " style="text-align: justify;">
                            <p style="text-align:center;">  
                                <img class="imgdis" id={{ $service->id }} onclick="displayIMG(this.id)"  src="\image\service\item\{{ $service->pic }}" alt="Snow" style="height:auto;width:auto;max-width:200px;max-height:200px;"></p>
                            <h4 align="center">{{ $service->serviceName }}</h4></div>
                      <p >{{ $service->description }}</p>
                      
                        
                        
                </div>
              </div>
            
            @endif
        @endforeach
    </div>
    
<div class="container">
        <br>
        <div class="col-12 panel panel-primary">
                    
            {{-- <div class="panel-body"><p style="text-align:center;"><img src="img/core-img/artificial.png" class="center" width="800" height="420"></p></div> --}}
            <div class="panel-heading"><p style="text-align:center;">
                 <img src="\img\icons\pedestrian-walking.png" width="75px" height="75px"></p><h4 align="center">Prosthesis care</h4>
        </div>
        </div>
@foreach($services as $service)

@if (($service->type)==="prosthesis")
<div class="col-12 col-sm-4 col-md-3 col-lg-3 text-center">
        <div class="panel panel-success ">
            <div class="panel-heading " style="text-align: justify;">
                    <p style="text-align:center;"> 
                         <img class="imgdis" id={{ $service->id }} onclick="displayIMG(this.id)"  src="\image\service\item\{{ $service->pic }}" alt="Snow" style="height:auto;width:auto;max-width:200px;max-height:200px;"></p>
                    <h4 align="center">{{ $service->serviceName }}</h4></div>
              <p >{{ $service->description }}</p>
              
        </div>
      </div>
    
    @endif
@endforeach
</div>
<div class="container">
        <br>
        <div class="col-12 panel panel-primary">
                    
            {{-- <div class="panel-body"><p style="text-align:center;"><img src="img/core-img/artificial.png" class="center" width="800" height="420"></p></div> --}}
            <div class="panel-heading"><p style="text-align:center;"> <img src="\img\icons\nose.png" width="75px" height="75px"></p><h4 align="center">Cosmetic solutions care</h4>
        </div>
        </div>
@foreach($services as $service)

@if (($service->type)==="cosmetic")
<div class="col-12 col-sm-4 col-md-3 col-lg-3 text-center">
        <div class="panel panel-success ">
            <div class="panel-heading " style="text-align: justify;">
                    <p style="text-align:center;">  
                        <img class="imgdis" id={{ $service->id }} onclick="displayIMG(this.id)"  src="\image\service\item\{{ $service->pic }}" alt="Snow" style="height:auto;width:auto;max-width:200px;max-height:200px;"></p>
                    <h4 align="center">{{ $service->serviceName }}</h4></div>
              <p >{{ $service->description }}</p>
             
        </div>
      </div>
    
    @endif
@endforeach
</div>
<div class="container">
        <br>
        <div class="col-12 panel panel-primary">
                    
            {{-- <div class="panel-body"><p style="text-align:center;"><img src="img/core-img/artificial.png" class="center" width="800" height="420"></p></div> --}}
            <div class="panel-heading"><p style="text-align:center;"> <img src="\img\icons\chaild.png" width="75px" height="75px"></p><h4 align="center">Children care</h4>
        </div>
        </div>
@foreach($services as $service)

@if (($service->type)==="children")
<div class="col-12 col-sm-4 col-md-3 col-lg-3 text-center">
        <div class="panel panel-success ">
            <div class="panel-heading " style="text-align: justify;">
                    <p style="text-align:center;"> 
                         <img class="imgdis" id={{ $service->id }} onclick="displayIMG(this.id)"  src="\image\service\item\{{ $service->pic }}" alt="Snow" style="height:auto;width:auto;max-width:200px;max-height:200px;"></p>
                    <h4 align="center">{{ $service->serviceName }}</h4></div>
              <p >{{ $service->description }}</p>
              
        </div>
      </div>
    
    @endif
@endforeach
</div>
        @endif
    
    </div>
    <div id="myModal" class="modal">
            <span class="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
      </div>
    <script>
            // Get the modal
            var modal = document.getElementById('myModal');
            // var img=document.getElementById("myImg");
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
           
              function displayIMG(clicked_id)
            {
                modal.style.display = "block";
                modalImg.src = document.getElementById(clicked_id).src;
                captionText.innerHTML =document.getElementById(clicked_id).alt;
            }  
            
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
            
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() { 
                modal.style.display = "none";
            }
            </script>
@endsection