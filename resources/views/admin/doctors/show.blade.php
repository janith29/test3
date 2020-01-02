@extends('admin.layouts.admin')

@section('title', __('views.admin.users.show.title', ['name' => $doctor->name]))

@section('content')
    <div class="row">
        <table class="table table-striped table-hover">
            <tbody>
            <tr>
                <th>{{ __('views.admin.users.show.table_header_0') }}</th>
                <td>
                        <img height="200" width="200"  class="imgdis" id="{{ $doctor->id }}"  onclick="displayIMG(this.id)" src="\image\doc\profile\{{ $doctor->doc_pic }}" alt={{ $doctor->name }} style="width:100%;max-width:200px">{{-- {{ $employee->avatar }} --}}
                    
                        <div id="myModal" class="modal">
                                <span class="close">&times;</span>
                            <img class="modal-content" id="img01">
                            <div id="caption"></div>
                          </div>
            </tr>

            <tr>
                <th>{{ __('views.admin.users.show.table_header_1') }}</th>
                <td>{{ $doctor->name }}</td>
            </tr>

            <tr>
                <th>Doctor Email</th>
                <td>
                    {{-- <a href="mailto:{{ $doctor->doctorType }}"> --}}
                    {{ $doctor->email }}
                    {{-- </a> --}}
                </td>
            </tr>

            <tr>
                <th>Hospital</th>
                <td>
                    {{ $doctor->hospital }}
                </td>
            </tr>

            <tr>
                <th>Mobile</th>
                <td>
                    {{ $doctor->mobile }}
                </td>
            </tr>



            <tr>
                <th></th>
                <td><a href="{{ URL::previous() }}" class="btn btn-light"><i class="fa fa-arrow-left"></i> Go Back</a></td>
                {{-- href="{{ route('admin.doctors') }}" --}}
            </tr>
            </tbody>
        </table>
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