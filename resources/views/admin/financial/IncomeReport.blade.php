@extends('admin.layouts.admin')
@section('content')
<div class="row title-section">
        <div class="col-12 col-md-8">
        @section('title', "Report generator")


    </div>
    <div class="row">
            <div class="col-md-6 col-xs-8 col-sm-12">
               <h4> Income report generator</h4>
                    <form action="Incomereport" method="post">

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
            <div class="col-md-6 col-xs-8 col-sm-12">
                    <h4> Outcome report generator</h4>
                    <form action="Incomereport" method="post">

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
            <div class="col-md-6 col-xs-8 col-sm-12">
                    <h4> Workshop Expenses report generator</h4>
                    <form action="Incomereport" method="post">

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
          
        </div>
@endsection