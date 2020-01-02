@extends('admin.layouts.admin')

@section('title', __('views.admin.users.show.title', ['name' => $patient->name]))

@section('content')
    <div class="row">
        <table class="table table-striped table-hover">
            <tbody>
            <tr>
                <th>{{ __('views.admin.users.show.table_header_0') }}</th>
                <td>
                     <img id="myImg" src="\image\pat\profile\{{ $patient->pat_pic }}" alt="Snow" style="width:100%;max-width:200px">{{-- {{ $employee->avatar }} --}}
                    <div id="myModal" class="modal">
                        <span class="close">&times;</span>
                        <img class="modal-content" id="img01">
                        <div id="caption"></div>
                      </div>
                      
            </tr>
            @php
                
            use Illuminate\Support\Facades\DB;
            
            $invoice=DB::select("select * from invoice WHERE patient_ID = ".$patient->id.";");
            $diagnosiss=DB::select("select * from diagnosis WHERE patientname = ".$patient->id.";");
            @endphp
          
            <tr>
                <th>{{ __('views.admin.users.show.table_header_1') }}</th>
                <td>{{ $patient->name }}</td>
            </tr>
          

            <tr>
                <th>E-Mail</th>
                <td>
                    {{-- <a href="mailto:{{ $patient->patientType }}"> --}}
                    {{ $patient->email }}
                    {{-- </a> --}}
                </td>
            </tr>
            <tr>
                <th>Gender</th>
                <td>
                    {{-- <a href="mailto:{{ $patient->patientType }}"> --}}
                    {{ $patient->Gender}}
                    {{-- </a> --}}
                </td>
            </tr>

            <tr>
                <th>NIC</th>
                <td>
                    {{ $patient->nic }}
                </td>
            </tr>

            <tr>
                <th>Address</th>
                <td>
                    {{ $patient->address }}
                </td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td>
                    {{ $patient->mobile }}
                </td>
            </tr>
            <tr>
                <td>

                <a href="{{ route('admin.financial.newinvoice', [$patient->id]) }}" class="btn btn-success">Add Invoice</a>
                     
                </td>
            </tr>
            <tr>
                    <td>
    
                            <h3>Diagnosis details</h3>
                 
                    </td>
                    <td>
                            <a class="btn btn-xs btn-info" href="{{ route('admin.diagnosis.add',$patient->id) }}">
                                   Add diagnosis card
                                </a>
                    </td>
                </tr>
            @foreach ($diagnosiss as $diagnosis)
                    
            <tr>
                    <td>{{ $diagnosis->service }}</td>
                <td>
                        <a class="btn btn-xs btn-warning" href="{{ route('admin.diagnosis.show',[$diagnosis->id]) }}">
                                <i class="fa fa-eye"></i>
                        </a>
                </td>
               
            </tr>

            @endforeach
            <tr>
                <td>

                        <h3>Invoice details</h3>
                </td>
            </tr>
            <tr>
                <td>
                    Invoice id
                </td>
                <td>
                    Amount <b>/</b> Remaining amount
                </td>
            </tr>
            @foreach ($invoice as $invoic)
            <tr>
                 
                <td>
                        {{ $invoic->id }}
                    </td>
                <td>

                        {{ $invoic->amount }}
                        /
                        {{ $invoic->remaining_amount }}
                    <a class="btn btn-xs btn-primary" href="{{ route('admin.financial.showinvoice', [$invoic->id]) }}">
                        <i class="fa fa-eye"></i>
                    </a>
                    @if ($invoic->remaining_amount >0)
                        
                    <a class="btn btn-xs btn-primary" href="{{ route('admin.financial.addbillinvoice', [$invoic->id]) }}">
                            <i class="fa fa-plus"></i>
                        </a>
                    @else
                        <u style="colore">Full paid</u>
                    @endif
                </td>
            </tr>
            @endforeach
            <tr>
                <td>

                        <h3>Bill details</h3>
                </td>
            </tr>

            <tr>
                    <td>
                            Bill id
                    </td>
                    <td>
                        Amount 
                    </td>
                </tr>
            @foreach ($invoice as $invoic)
            @php
                
            $bills=DB::select("select * from bill WHERE invoice_id = ".$invoic->id.";");
            @endphp
           @endforeach

           @foreach ($bills as $bill)
            <tr>
                    <td>
                        {{$bill->id}}
                    </td>
                <td>
                        {{$bill->amount}}


                    <a class="btn btn-xs btn-primary" href="{{ route('admin.financial.showBill', [$bill->id]) }}">
                        <i class="fa fa-eye"></i>
                    </a>
                    
                </td>
            </tr>
           
            @endforeach

            <tr>
                <th></th>
                <td><a href="{{ route('admin.patients') }}" class="btn btn-light"><i class="fa fa-arrow-left"></i> Go Back</a></td>
                {{-- href="{{ route('admin.patients') }}" --}}
            </tr>
            </tbody>
        </table>
    </div>
    <script>
            // Get the modal
            var modal = document.getElementById('myModal');
            
            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = document.getElementById('myImg');
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
            img.onclick = function(){
                modal.style.display = "block";
                modalImg.src = this.src;
                captionText.innerHTML = this.alt;
            }
            
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
            
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() { 
                modal.style.display = "none";
            }
            </script>
@endsection