@extends('admin.layouts.admin')

@section('title', "Invoice ID: " . $Invoice->id)

@section('content')
<div class="row">
        <table class="table table-striped table-hover">
            <tbody>
                <tr>
                    
                    <td><center><img src="\image\finacial\bill.png"  alt="Pic" height="90" width="90" class="user-profile-image"></center></td>
        
                </tr>
                @php
                
                use Illuminate\Support\Facades\DB;
                
                $services=DB::select("select * from service WHERE id = ".$Invoice->service.";");
                foreach ($services as $service)
                {
                    $Invoice->service=$service->serviceName;
                }
                @endphp
                @php
                $name='no';
                $patintID='no';
                foreach ($patients as $patient)
                {
                if($Invoice->patient_ID==$patient->id)
                {
                    $name=$patient->name;
                    $patintID=$patient->id;
                }
                }@endphp
                <tr>
                    <th>Patient Name</th>
                    <td>
                        {{ $name }}
                        
                    </td>
                </tr>
    
                <tr>
                    <th>Total amount</th>
                    <td>{{ $Invoice->amount }}</td>
                </tr>
                <tr>
                    <th>Total service</th>
                    <td>{{ $Invoice->service }}</td>
                </tr>
                <tr>
                    <th>Remaining amount</th>
                    <td>
                        {{ $Invoice->remaining_amount }}
                    </td>
                </tr>
                <tr>
                        <tr>
                                <th>Print</th>
                                <td> 
                                    <form action="printinvoice" method="post">
                                            {{ csrf_field() }}
                                        <input type="hidden" id="inID" name="inID" value="{{$Invoice->id}}">
                                        <input type="hidden" id="reamount" name="reamount" value="{{$Invoice->remaining_amount}}">
                                        <input type="hidden" id="service" name="service" value="{{$Invoice->service}}">
                                        <input type="hidden" id="amount" name="amount" value="{{$Invoice->amount}}">
                                        <input type="hidden" id="patintID" name="patintID" value="{{$patintID}}">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                                    </form>
                                </td>
                            </tr>
                <tr>
                    <th></th>
                    <td><a href="{{ URL::previous() }}" class="btn btn-light"><i class="fa fa-arrow-left"></i> Go Back</a></td>
                    {{-- href="{{ route('admin.employees') }}" --}}
                </tr>
                
            </tbody>
        </table>
    </div>
@endsection