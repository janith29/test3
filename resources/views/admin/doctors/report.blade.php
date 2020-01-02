@extends('admin.layouts.admin')
<head>

</head>
@section('title',"Doctor Report Generate ", "Doctor")
<body>
@section('content')
    <div class="row tile_count">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-users"></i>Total Doctors</span>
            <div class="count green">{{ $counts['Doctors'] }}</div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-users"></i>Total Hospitals </span>
            <div class="count green">{{ $counts['hospital'] }}</div>
        </div>
    </div>
    <div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <h1>Period Report Genarate</h1>
        <form action="report" method="post">

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

{{--<h1>Bar chart Of Doctors</h1>--}}

        {{--<div class="container">--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-10 col-md-offset-1">--}}
                    {{--<div class="panel panel-default">--}}
                        {{--<div class="panel-heading">Dashboard</div>--}}
                        {{--<div class="panel-body">--}}
                            {{--<canvas id="canvas" height="280" width="600"></canvas>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{----}}
    {{--</div>--}}
</body>
@endsection


@section('styles')
    @parent
    {{ Html::style(mix('assets/admin/css/users/edit.css')) }}
@endsection

@section('scripts')
    @parent
    {{ Html::script(mix('assets/admin/js/users/edit.js')) }}


@endsection
