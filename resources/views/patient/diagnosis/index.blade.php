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
        $diagnosise = DB::select('select * from diagnosis where patientname ='.$IDpa);
        $patientname='n';
            $service='n';
            $consultant_dr='n';
            $discription='n';
            $hight='n';
            $weight='n';
            $skech='n';


@endphp
@section('content')
<div class="row">
    <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
            width="100%">
        <thead> 
        <tr>
            <th>DID</th>
            <th>Patient name</th>
            <th>Service</th>
            <th>Doctor name</th>
            <th>Actions{{ $IDpa}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($diagnosise as $diagnosis)
            <tr> 
                <td>{{ $diagnosis->Did }}</td>
                <td>{{ $diagnosis->patientname }}</td>
                <td>{{ $diagnosis->service }}</td>
                <td>{{ $diagnosis->consultant_dr }}</td>
                <td>
                    <a class="btn btn-xs btn-primary" href="{{ route('patient.diagnosis.show',[$diagnosis->id]) }}">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
<div class="pull-right">
</div>
</div>
    
        <a href="{{ route('patient.patients') }}" class="btn btn-danger">Patient home</a>
    </div>
@endsection