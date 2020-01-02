@extends('admin.layouts.admin')
@section('content')
<div class="row title-section">
        <div class="col-12 col-md-8">
        @section('title', "Outcome Report")


    <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                    <div id="log_activity" class="dashboard_graph">
                        <div class="col-md-3 col-sm-3 col-xs-12 bg-white">

                            <form action="Outcomereport" method="post">

                                {{ csrf_field() }}

                                <div class="form-row">


                                    <div class="col">
                                        <label for="inputAddress">Starting From</label>
                                        <input type="date" name="from_date" class="form-control" id="inputAddress" value="">
                                    </div>
                                    <div class="col">
                                        <label for="inputAddress">End Date</label>
                                        <input type="date" name="to_date" class="form-control" id="inputAddress" value="">
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">Genarate</button>

                                    </div>
                                </div>

                            </form>

                        </div>
        
                        <div class="clearfix"></div>
                    </div>
                </div>
    </div>
@endsection