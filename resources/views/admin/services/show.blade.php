@extends('admin.layouts.admin')
@section('title', "Services Management")

@section('content')
    <div class="row">
            <div class="row">
                <div class="col-xs-9 col-md-7" ></div>
                <div class="col-xs-3 col-md-5">
                        <a class="btn btn-info" href="{{ route('admin.servicesphoto',[$Services->id]) }}">Add photo</a>
                        <a class="btn btn-info" href="{{ route('admin.servicesvideo',[$Services->id]) }}">Add video</a>
   
                </div>
            </div>
        <table class="table table-striped table-hover">
            <tbody>
            <tr>
                <th>Services Image</th>
                <td>
                        <img  id="myImg" onclick="displayIMG(this.id)" height="200" width="200" src="\image\service\item\{{$Services->pic}}" alt={{ $Services->name }}>{{-- {{ $employee->avatar }} --}}
                     
                        {{-- <img height="200" width="200" src="\image\service\item\{{$Services->pic}}" class="user-profile-image"></td> --}}
            </tr>

            <tr>
                <th>Services name</th>
                <td>{{ $Services->serviceName }}</td>
            </tr>
            <tr>
                    <th>Services DID</th>
                    <td>{{ $Services->Did }}</td>
                </tr>
            <tr>
                <th>Services type</th>
                <td>
                        {{ $Services->type }}
                    </a>
                </td>
            </tr>
            <tr>
                <th>Services description</th>
                <td>
                    {{ ($Services->description)}} 
                </td>
            </tr>
            <tr>
                    <th>Our Photos</th>
                    <td>
                        @php
                            use Illuminate\Support\Facades\DB;
                            $ourphotos = DB::table('service_photo')->where('serviceID', $Services->id)->get();
                            $ourvideos = DB::table('service_video')->where('serviceID', $Services->id)->get();
                        @endphp
    
                        @foreach($ourphotos as $ourphoto)
                        
                        <img  id={{ $ourphoto->id }} onclick="displayIMG(this.id)" height="200px" width="200px" src="\image\service\item\our\{{$ourphoto->photo}}" alt={{ $Services->serviceName }}>{{-- {{ $employee->avatar }} --}}
                        <a class="btn btn-xs btn-danger" href="{{ route('admin.servicesphotodestroy',[$ourphoto->id]) }}">
                                <i class="fa fa-trash"></i>
                            </a>
                        @endforeach
                    </td>
                </tr><tr>
                        <th>Our Video</th>
                        <td>
                            @foreach($ourvideos as $ourvideo)
        
                            <iframe width="300px" height="200px" src="https://www.youtube.com/embed/{{$ourvideo->embed}}">
                            </iframe>
                            <a class="btn btn-xs btn-danger" href="{{ route('admin.servicesvideodestroy',[$ourvideo->id]) }}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            @endforeach
                        </td>
                    </tr>
            </tbody>
        </table>
        <a href="{{ route('admin.services') }}" class="btn btn-danger">Store home</a>
        <a class="btn btn-info" href="{{ route('admin.services.edit',[$Services->id]) }}">Edit</a>
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