@extends('admin.layouts.admin')

@section('title', __('views.admin.users.show.title', ['name' => $employee->name]))

@section('content')
    <div class="row">
        <table class="table table-striped table-hover">
            <tbody>
            <tr>
                <th>{{ __('views.admin.users.show.table_header_0') }}</th>
               
                {{-- hhh<img src="\image\emp\profile\{{ $employee->emp_pic }}"  alt="Pic" height="90" width="90" class="user-profile-image "> </td>--}}
                <img  id="myImg" onclick="displayIMG(this.id)"  src="\image\emp\profile\{{ $employee->emp_pic }}" alt={{ $employee->name }} style="width:100%;max-width:200px">{{-- {{ $employee->avatar }} --}}
                <div id="myModal" class="modal">
                        <span class="close">&times;</span>
                    <img class="modal-content" id="img01">
                    <div id="caption"></div>
                  </div>
                  
                  
            </tr>

            <tr>
                <th>{{ __('views.admin.users.show.table_header_1') }}</th>
                <td>{{ $employee->name }}</td>
            </tr>

            <tr>
                <th>Employee Type</th>
                <td>
                    {{-- <a href="mailto:{{ $employee->employeeType }}"> --}}
                    {{ $employee->employeeType }}
                    {{-- </a> --}}
                </td>
            </tr>

            <tr>
                <th>NIC</th>
                <td>
                    {{ $employee->nic }}
                </td>
            </tr>

            <tr>
                <th>Address</th>
                <td>
                    {{ $employee->address }}
                </td>
            </tr>
            <tr>
                <th>Birthday</th>
                <td>
                    {{ $employee->birthday }}
                </td>
            </tr>
            <tr>
                <th>Email</th>
                <td>
                    {{ $employee->email }}
                </td>
            </tr>
            <tr>
                <th>Contact Number</th>
                <td>
                    {{ $employee->contactNo }}
                </td>
            </tr>
            <tr>
                <th>Initial Salary</th>
                <td>
                    @foreach ($initial_salary as $item)
                        {{ $item->basic_salary }}
                    @endforeach
                </td>
            </tr>

            <tr>
                <th>Created At</th>
                <td>{{ $employee->created_at }} ({{ $employee->created_at->diffForHumans() }})</td>
            </tr>

            <tr>
                <th>Updated At</th>
                <td>{{ $employee->updated_at }} ({{ $employee->updated_at->diffForHumans() }})</td>
            </tr>

            <tr>
                <th></th>
                <td><a href="{{ URL::previous() }}" class="btn btn-light"><i class="fa fa-arrow-left"></i> Go Back</a></td>
                {{-- href="{{ route('admin.employees') }}" --}}
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