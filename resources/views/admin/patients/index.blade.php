@extends('admin.layouts.admin')

@section('title', "Patient Management")

@section('content')
    <link href="{{ asset('admin/css/userstyles.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="row">
        <table  class="table table-striped table-bordered dt-responsive nowrap"  cellspacing="0" width="100%" border="0">
            <thead>
            <tr>
                

                    <div class="demptable">
                        {{ link_to_route('admin.diagnosis.index', 'Diagnosis Card', null, ['class' => 'btn btn-warning']) }}
                        {{ link_to_route('admin.patient.add', 'Add Patient', null, ['class' => 'btn btn-primary']) }}
                        {{ link_to_route('admin.patient.chartView', 'Report', null, ['class' => 'btn btn-primary']) }}
                        <div class="right-searchbar">
                                <!-- Search form -->
                                <form action="patientsearch" method="post" class="form-inline">
                                        {{ csrf_field() }}
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="search" placeholder="Search" aria-label="Search" required />
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" style="margin-top: -10px;" type="submit">Search</button>
                                    </div>
                                    {{-- <i class="fa fa-search" aria-hidden="true"></i> --}}
                                </form>
                            </div>
                        
                    </div>

                    
            </tr>
            </thead>
        </table>
        @if(Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
        @endif

            <div class="row">
                @foreach($patients as $patient)

            <div class="col-xs-6 col-sm-3">
                <div class="dcard">
                    <div class="row">
                        <div class="dcard-header">
                            <div class="dcard-body text-center" style="font-size: larger; color: white">
                                
                                <span class="dcard-title ">{{ str_limit($patient->name , 15)}}</span><br />
                                <span class="dcard-title ">{{ $patient->Did }}</span><br />
                            </div>
                        <br/>
                            <div class="dcard-body text-center">
                                <img src="\image\pat\profile\{{ $patient->pat_pic }}" alt="Pic" height="90" width="90"class="img-circle">
                            </div>
                            {{-- <span class="card-img">{{ HTML::image('img/nickfrost.jpg', 'Pic') }}</span> --}}

                        </div>
                    </div>
                    <div class="dcard-body text-center">
                        {!! Form::open(array('route' => ['admin.patient.delete', $patient->id], 'method' => 'POST')) !!}
                        <a href="{{ route('admin.patient.show', [$patient->id]) }}" class="btn btn-primary">View</a>
                        <br/>
                        <a href="{{ route('admin.patient.edit', [$patient->id]) }}" class="btn btn-success">Update</a>
                        {{-- <a href="{{ route('admin.patients.delete') }}" class="btn btn-danger">Delete</a> --}}
                        {!! Form::button('Delete', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            @endforeach

        <div class="pull-right">
            {{-- {{ $users->links() }} --}}
        </div>
    </div>
@endsection
@section('styles')
    @parent
    {{ Html::style(mix('assets/admin/css/dashboard.css')) }}


@endsection