@extends('admin.layouts.admin')

@section('title', "Patient Management")

@section('content')
    <div class="row">
        <table class="table table-striped table-hover">
            <tbody>
            <tr> 
                <th><h4>Primary sketch</h4></th>
                <td>
                    <img height="200" width="200" class="imgdis"  id="{{ $diagnosis->Did }}" onclick="displayIMG(this.id)"  src="\image\diagnosis\sketch\{{ $diagnosis->skech }}" alt={{ $diagnosis->patientname}} style="width:100%;max-width:200px">{{-- {{ $employee->avatar }} --}}
                    <div id="myModal" class="modal">
                            <span class="close">&times;</span>
                        <img class="modal-content" id="img01">
                        <div id="caption"></div>
                      </div>
                </tr>
                @php
                
use Illuminate\Support\Facades\DB;
                $diagnosise = DB::select('select * from patient where id ='.$diagnosis->patientname );
          foreach($diagnosise as $diagnosiss)
          {
            $diagnosis->patientname=$diagnosiss->name;
          }
          @endphp
               
                <tr>
                    <th>Patient name</th>
                    <td>{{ $diagnosis->patientname }}</td>
                </tr>
            <tr>
                    <th>Patient Did</th>
                    <td>{{ $diagnosis->Did }}</td>
                </tr>

            <tr>
                <th>Patient service</th>
                <td>
                        {{ $diagnosis->service }}
                    </a>
                </td>
            </tr>
            <tr>
                <th>Discription</th>
                <td>
                    {{ $diagnosis->discription }}
                </td>
            </tr>
            <tr>
                <th>Consultant doctor</th>
                <td>
                        {{ ($diagnosis->consultant_dr)}}
                        
                </td>
            </tr>
            <tr>
                <th>Hight</th>
                <td>
                        {{ ($diagnosis->hight)}} cm
                        
                </td>
            </tr>
            <tr>
                <th>Weight</th>
                <td>
                        {{ ($diagnosis->weight)}} kg
                        
                </td>
            </tr>
            <tr><form action="adddiagnosissketch" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <th><label for="pa_sketch">Other Sketch *</label></th>
                <td>
                        <div class="form-group">
                                <label for="DISDIP">Sketch note*</label>
                                <input type="text" class="form-control" name="DISDIP" id="DISDIP" placeholder="note" >
                            </div>
                    <div class="form-group">
                        
                        <input type="file" class="form-control" name="dia_sketch" id="dia_sketch"  multiple accept='image/*'>
                        <input type="hidden" id="disId" name="disId" value={{ $diagnosis->id }}>
                    </div><div class="form-group">
                        <button type="submit" class="btn btn-primary">Add</button></div>
                    </td>
                    </form>
            </tr>
            </tbody>
        </table>
        @php
        $DSphoto =DB::select('select * from diagnosisphoto WHERE diagnosis_ID ='.$diagnosis->id.'');  
        
        @endphp
         <div class="container">
        @foreach($DSphoto as $DSphotos)
        {{-- @if (($DSphotos->id)===($diagnosis->id)) --}}
          <div class="  col-lg-3 text-center">
            <div class="panel panel-success ">
                <div class="panel-heading " style="text-align: justify;">
                    
                    <p style="text-align:center;"> 
                        <img height="200" width="200"  class="imgdis" id={{ $DSphotos->id }} onclick="displayIMG(this.id)"  src="\image\diagnosis\sketch\other\{{ $DSphotos->diagnosis_pic }}" alt="{{ $DSphotos->discription }}" style="height:200px;width:200px;max-width:200px"></p>
                        <h4 align="center">{{ $DSphotos->discription }}</h4>        
            </div>
          </div>
          </div>

          {{-- @endif --}}
          @endforeach
         </div>
        <a href="{{ route('admin.diagnosis.index') }}" class="btn btn-danger">Diagnosis home</a>
        <a class="btn btn-info" href="{{ route('admin.diagnosis.edit',[$diagnosis->id]) }}">edit</a>
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