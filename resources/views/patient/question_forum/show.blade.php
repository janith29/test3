@extends('patient.layouts.patient')

@section('title', "Question Forum Management")

@section('content')
    <div class="row">
        <table class="table table-striped table-hover">
            <tbody> 
            @foreach($Question as $Questions)
            @if(!strcmp(($Questions->questionPic),'nophoto')==0)
            <tr>
                <th>Image</th>
                <td><img style="height:auto;width:auto;max-width:200px;max-height:200px;"  src="\image\question\pic\{{ $Questions->questionPic }}" class="user-profile-image imgdis" id={{ $Questions->id }} onclick="displayIMG(this.id)"></td>
            </tr>
            @endif
            <tr>
                <th>Question title</th>
                <td>{{$Questions->questionTitle}}</td>
            </tr>
            <tr>
                <th>Question </th>
                <td>{{$Questions->question}}</td>
            </tr>
           
           @foreach($replys as $replyw)
           @if(!strcmp(($replyw->replay_pic),'nophoto')==0)
           <tr>
                <th>Image of reply</th> 
                <td><img style="height:auto;width:auto;max-width:200px;max-height:200px;" src="\image\reply\pic\{{ $replyw->replay_pic }}" class="user-profile-image imgdis" id={{ $replyw->id }} onclick="displayIMG(this.id)"></td>
            </tr>
            @endif
           <tr>
                <th>Reply</th>
                <td>{{$replyw->replay}}</td>
            </tr>
           @endforeach
            </tbody>
            <tr>
                    <th></th><td>
            @if (!$errors->isEmpty())
            
            <div class="alert alert-danger" role="alert">
                {!! $errors->first() !!}
            </div>
        </td>
             </tr>
        @endif
            
            
            
        </table>
        <a href="{{ route('patient.question_forum') }}" class="btn btn-danger">Questions Forum home</a>
        
    @endforeach
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