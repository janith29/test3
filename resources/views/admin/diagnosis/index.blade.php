@extends('admin.layouts.admin')
@section('content')
    <div class="row title-section">
        <div class="col-12 col-md-8">
        @section('title', "Diagnosis Management")
        </div>
        <div class="col-8 col-md-4" style="padding-bottom: 15px;">
            <div class="topicbar">
                <a href="{{ route('admin.diagnosis.indexadd') }}" class="btn btn-primary">Add diagnosis card</a>
                <a href="{{ route('admin.diagnosis.DiaReport') }}" class="btn btn-primary">Diagnosis Report</a>

            </div>
            <div class="right-searchbar">
                    <!-- Search form -->
                    <form action="searchdiagnosis" method="post" class="form-inline">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <input class="form-control" type="text" name="search" placeholder="Search diagnosis" aria-label="Search" required />
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
                    @foreach($diagnosise as $diagnosis)
                        <tr> 
                            <td>{{ $diagnosis->Did }}</td>
                            <td>{{ $diagnosis->patientname }}</td>
                            <td>{{ $diagnosis->service }}</td>
                            <td>{{ $diagnosis->consultant_dr }}</td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.diagnosis.show',[$diagnosis->id]) }}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a class="btn btn-xs btn-info" href="{{ route('admin.diagnosis.edit',[$diagnosis->id]) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a class="btn btn-xs btn-danger" href="{{ route('admin.diagnosis.delete',[$diagnosis->id]) }}">
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
@endsection