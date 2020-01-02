@extends('patient.layouts.patient')

@section('title', "Patient Management")
@php
use Illuminate\Support\Facades\DB;
$email=auth()->user()->email;
$IDs = DB::table('patient')->where('email', $email)->get();
$IDpa = 0;
foreach($IDs as $ID)
{
$IDpa=$ID->id;
}
$patients = DB::select('select * from doctors ');
//
@endphp
@section('content')
    <div class="row">
        <table border="0" cellspacing="0" width="100%" class="doctortable">
            <table>
                
            </table>
            <br/>
            <br/>
            <div class="row">
                @if(Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif

                @foreach ($patients as $doctor)
                    <div class="col-xs-6 col-sm-3">

                        <div class="dcard">
                            <div class="row">
                                <div class="dcard-header">
                                    <div class="dcard-body text-center">
                                        <span class="dcard-title" style="font-size: large; color: white">Name :{{ $doctor->name }}</span><br />
                                    </div>
                                    <div class="dcard-body text-center">
                                        <span class="dcard-title" style="font-size: large; color: white">hospital :{{ $doctor->hospital }}</span><br />
                                    </div>
                                    

                                    <br/>
                                    <div class="dcard-body text-center">
                                        <img src="\image\doc\profile\{{ $doctor->doc_pic }}" alt="Pic" height="90" width="90"class="img-circle " id={{ $doctor->id }} onclick="displayIMG(this.id)">
                                    </div>
                                    <div id="myModal" class="modal">
                                        <span class="close">&times;</span>
                                    <img class="modal-content" id="img01">
                                    <div id="caption"></div>
                                  </div>
                                    {{-- <span class="card-img">{{ HTML::image('img/nickfrost.jpg', 'Pic') }}</span> --}}
                                    <br/>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                @endforeach
                <div class="pull-right">
                    {{-- {{ $users->links() }} --}}
                </div>
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
@section('styles')
    @parent
    {{ Html::style(mix('assets/admin/css/dashboard.css')) }}
@endsection