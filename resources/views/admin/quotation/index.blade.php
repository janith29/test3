@extends('admin.layouts.admin')
@section('content')
    <div class="row title-section">
        <div class="col-12 col-md-8">
        @section('title', "Quotation Management")
        </div>
        <div class="col-8 col-md-4" style="padding-bottom: 15px;">
            <div class="topicbar">
                <a href="{{ route('admin.quotation.add') }}" class="btn btn-primary">Add Quotation</a>
            </div>
            <div class="right-searchbar">
                    <!-- Search form -->
                    <form action="searchQuotation" method="post" class="form-inline">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <input class="form-control" type="text" name="search" placeholder="Search" aria-label="Search" required />
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-primary" style="margin-top: -10px;" type="submit">Search</button>
                        </div>
                        {{-- <i class="fa fa-search" aria-hidden="true"></i> --}}
                    </form>
                </div>
           
        </div>
    </div>
    <div class="row">
        @if ($quotations->isEmpty())
        <div class="alert alert-danger" role="alert">
                <p>Not have Data in service table</p>
        </div>
        @else
        <div class="container">
                <br>
               
        
        <div class="row">
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                    width="100%">
                <thead> 
                <tr>
                    <th>DID</th>
                    <th>Patient name</th>
                    <th>Service</th>
                    <th>Doctor name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($quotations as $quotation)
                    <tr> 
                        <td>{{ $quotation->did }}</td>
                        <td>{{ $quotation->name }}</td>
                        <td>{{ $quotation->divice }}</td>
                        <td>{{ $quotation->diagnosis }}</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.quotation.show',[$quotation->id]) }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-xs btn-info" href="{{ route('admin.quotation.edit',[$quotation->id]) }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a class="btn btn-xs btn-danger" href="{{ route('admin.quotation.delete',[$quotation->id]) }}">
                                <i class="fa fa-trash"></i>
                            </a>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    <div class="pull-right">
    </div>
</div>
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