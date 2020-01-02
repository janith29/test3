@extends('admin.layouts.admin')
@section('content')
    <div class="row title-section">
        <div class=".col-xs-12 .col-sm-6 .col-lg-8">
            @section('title', "Employee Management")
        </div>
        <div class=".col-xs-6 .col-lg-4 searchbar-addbt">
            <div class="topicbar form-group">
                {{-- <a href="{{ route('admin.employees.add') }}" class="btn btn-primary">Add Employee</a> --}}
                {{ link_to_route('admin.employees.add', 'Add Employee', null, ['class' => 'btn btn-primary']) }}
                {{-- {{ link_to_route('admin.employees.report', 'Generate Report', null, ['class' => 'btn btn-info', 'data-toggle' => 'modal', 'data-target' => '#exampleModalLong']) }} --}}
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalLong">
                    Generate Report
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">  
                            {!! Form::open(array('route' => 'admin.employees.rep', 'enctype' =>'multipart/form-data', 'class' => 'form-inline')) !!}
                            {!! Form::token() !!}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Download Employees report</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="created_date" class="col-form-label">From:</label>
                                    {!! Form::date('created_date', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    <label for="to_date" class="col-form-label">To:</label>
                                    {!! Form::date('to_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    <label for="sort_by" class="col-form-label">Sort By:</label>
                                    {!! Form::select('sort_by', ['name' => 'name', 'email' => 'email', 'employeeType' => 'Employee Type'], 'name', ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                {!! Form::submit('Generate', ['class' => 'btn btn-info', 'style' => 'margin-top: 10px;']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-searchbar">
                <!-- Search form -->
                <form action="{{ route('admin.employees') }}" method="get" class="form-inline">
                    <div class="form-group">
                        <input class="form-control" type="text" name="key" placeholder="Search" aria-label="Search" value="{{isSet($key) ? $key : ''}}" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" style="margin-top: -10px;" type="submit">Search</button>
                    </div>
                    {{-- <i class="fa fa-search" aria-hidden="true"></i> --}}
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        @if(Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
        @endif
        {{-- @foreach($users as $user) --}}
        <div class="container">
        <div class="row">
            @foreach($employees as $employee)
            <div class="col-xs-5 col-sm-2">
                    <div class="dcard">
                        <div class="row">
                                <div class="panel panel-info ">
                                        <div class="panel-heading " >
                            <div class="dcard-header">
                                <div class="dcard-body text-center" style="font-size: larger; color: black">
                                  
                                   <span class="dcard-title ">{{  str_limit($employee->name , 15)}}</span><br />
                                    <span class="dcard-title ">{{ $employee->Did }}</span><br />
                                </div>
                            <br/>
                                <div class="dcard-body text-center">
                                        <img src="\image\emp\profile\{{ $employee->emp_pic }}" alt="Pic" height="90" width="90"class="img-circle">
                                     </div>
                                {{-- <span class="card-img">{{ HTML::image('img/nickfrost.jpg', 'Pic') }}</span> --}}
                            </div>
                        </div>
                        <div class="dcard-body text-center">
                            {!! Form::open(array('route' => ['admin.employees.delete', $employee->id], 'method' => 'POST')) !!}
                            <a href="{{ route('admin.employees.show', [$employee->id]) }}" class="btn btn-primary">View</a>
                            <br/>
                           
                            <a href="{{ route('admin.employees.edit', [$employee->id]) }}" class="btn btn-success">Update</a>
                            {{-- <a href="{{ route('admin.patients.delete') }}" class="btn btn-danger">Delete</a> --}}
                           
                            {!! Form::button('Delete', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
                            {!! Form::close() !!}
                          
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-1 col-sm-1">
                </div>
               
                {{-- <div class="col-xs-6 col-sm-3">
                    <div class="card bg-info text-white">
                        <div class="row">
                            <div class="card-header">
                                <div class="col-xs-6 vcenter emp-avator">
                                        <p style="text-align:center;"> 
                                    <img src="\image\emp\profile\{{ $employee->emp_pic }}" alt="Pic" height="90" width="90"class="img-circle">
                                        </p>
                                </div>
                                {{-- <span class="card-img">{{ HTML::image('img/nickfrost.jpg', 'Pic') }}</span> --}}
                                 {{-- <div class="col   vcenter emp-details">
                                        <p style="text-align:center;" class="card-title">   {{ $employee->name }} </p>
                                        <p style="text-align:center;"><span class="card-subtitle">{{$employee->Did }}</span></p>
                                </div>
                                
                            </div>
                        </div>
                        <div class="card-body text-center">
                            {!! Form::open(array('route' => ['admin.employees.delete', $employee->id], 'method' => 'DELETE', 'onSubmit'=> 'return confirm("Do you really want to delete?");')) !!}
                                <a href="{{ route('admin.employees.show', [$employee->id]) }}" class="btn btn-info">View</a>
                                <a href="{{ route('admin.employees.edit', [$employee->id]) }}" class="btn btn-success">Update</a>
                                {{-- <a href="{{ route('admin.employees.delete') }}" class="btn btn-danger">Delete</a> --}}
                                {{-- {!! Form::button('Delete', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div> --}} 
                {{-- @if(Session::has('message'))
                    <div id="myModal" class="modal fade in" style="display: block; margin-top: 160px; margin-left: 100px;">
                        <div class="modal-dialog modal-confirm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="icon-box">
                                        <i class="fa fa-trash"></i>
                                    </div>				
                                    <h4 class="modal-title">{{ $employee->name }}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <p>{{ Session::get('message') }}</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('admin.employees') }}" class="btn btn-danger">Ok</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif --}}
            @endforeach

            {{-- {{ $emp->appends(['key' => $key])->links() }} --}}
        </div> </div>
        <div class="pull-right">
            {{-- {{ $users->links() }} --}}
        </div>
    </div>
@endsection

@section('styles')
    @parent
    {{ Html::style('assets/admin/css/my_style.css') }}
@endsection