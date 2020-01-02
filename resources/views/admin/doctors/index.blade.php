@extends('admin.layouts.admin')

@section('title', "Doctor Management")

@section('content')
    <div class="row">
            <div class="col-12">
        <table  class="table table-striped table-bordered dt-responsive nowrap"  cellspacing="0" width="100%" border="0">
           
                <tr>

                    
                    <div class="demptable">
                        <a href="{{ route('admin.doctors.add') }}" class="btn btn-primary">Add Doctor</a>
                        <a href="{{ route('admin.doctors.report') }}" class="btn btn-primary">Report</a>
                        <div class="right-searchbar">
                                <!-- Search form -->
                                <form action="doctorsearch" method="post" class="form-inline">
                                        {{ csrf_field() }}
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="q" placeholder="Search Doctor" aria-label="Search" required />
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" style="margin-top: -10px;" type="submit">Search</button>
                                    </div>
                                    {{-- <i class="fa fa-search" aria-hidden="true"></i> --}}
                                </form>
                            </div>
                    </div>

                </tr>
            </table>
            <br/>
            <br/>
        </div>
            <div class="row">
                @if(Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif

                @foreach ($doctors as $doctor)
                    <div class="col-xs-6 col-sm-3">

                        <div class="dcard">
                            <div class="row">
                                <div class="dcard-header">
                                    <div class="dcard-body text-center">
                                        <span class="dcard-title" style="font-size: large; color: white">{{ $doctor->name }}</span><br />
                                    </div>
                                    <br/>
                                    <div class="dcard-body text-center">
                                        <img src="\image\doc\profile\{{ $doctor->doc_pic }}" alt="Pic" height="90" width="90"class="img-circle">
                                    </div>

                                    {{-- <span class="card-img">{{ HTML::image('img/nickfrost.jpg', 'Pic') }}</span> --}}
                                    <br/>
                                </div>
                            </div>
                            <div class="dcard-body text-center">
                                {!! Form::open(array('route' => ['admin.doctor.delete', $doctor->id], 'method' => 'DELETE')) !!}
                                <a href="{{ route('admin.doctors.show', [$doctor->id]) }}" class="btn btn-primary">View</a>
                                <br/>
                                <a href="{{ route('admin.doctors.edit', [$doctor->id]) }}" class="btn btn-success">Update</a>
                                {{-- <a href="{{ route('admin.doctors.delete') }}" class="btn btn-danger">Delete</a> --}}
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