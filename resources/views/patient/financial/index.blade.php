@extends('patient.layouts.patient')


@section('title', "Service Management")
@section('content')
    <div class="row">
    <div class="container">
        <div class="col-xs-6 col-sm-6 col-lg-5" ></div>
        <div class="col-xs-5 col-sm-6 col-lg-5" ></div>
    </div>
    </div>
                    <div class="row" >
                            <div class="col-xs-6">
                                            <center> <div class="card" style="width: 18rem;">
                                            <img class="card-img-top" src="\image\finacial\bill.png" alt="Card image cap" height="200" width="200"></center>
                                            <center><h2>Invoice </h2></center>
                                            <div class="row">
                                                   
                                                    
                                                    @if(Session::has('message'))compact('patients'),compact('Invoices')
                                                        <div class="alert alert-success">{{ Session::get('message') }}</div>
                                                    @endif
                                                    <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="95%">
                                                        <thead> 
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Total  Amount</th>
                                                            <th>Amount</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                                @php
                                                                
                                                            use Illuminate\Support\Facades\DB;
                                                            $email=auth()->user()->email;

                                                            $IDs = DB::table('patient')->where('email', $email)->get();
                                                            $IDpa = 0;
                                                                foreach($IDs as $ID)
                                                                {
                                                                    $IDpa=$ID->id;
                                                                    
                                                                }
                                                             $billsd=DB::select('select * from invoice WHERE `patient_ID` ='.$IDpa);

                                                                @endphp
                                                             @foreach ($billsd as $Invoice)
                                                                <tr>
                                                                       
                                                                    <td>{{ $Invoice->id }}</td>
                                                                    
                                                                    <td>{{ $Invoice->amount }}</td>
                                                                    <td>{{ $Invoice->remaining_amount}}</td>
                                                                    <td>
                                                                        <a class="btn btn-xs btn-primary" href="{{ route('patient.financial.showinvoice', [$Invoice->id]) }}">
                                                                            <i class="fa fa-eye"></i>
                                                                        </a>
                                                                        
                                                                    </td>
                                                                </tr>
                                                            @endforeach 
                                                        </tbody>
                                                    </table>    
                                                </div>
                                          
                                      
                            </div>
                            <div class="col-xs-6">
                                           <center> <div class="card" style="width: 18rem;">
                                            <img class="card-img-top" src="\image\finacial\payement.png" alt="Card image cap" height="200" width="200"></center>
                                            <center><h2>Bill</h2> </center>
                                            <div class="row">
                                                   
                                                    
                                                    @if(Session::has('message'))compact('patients'),compact('Invoices')
                                                        <div class="alert alert-success">{{ Session::get('message') }}</div>
                                                    @endif
                                                    <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="95%">
                                                        <thead> 
                                                        <tr><th> </th>
                                                            <th>ID</th>
                                                            <th>Bill  Amount</th>
                                                            <th>Remaining Amount</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                                @php
                                                                
                                                                $email=auth()->user()->email;
    
                                                                $IDs = DB::table('patient')->where('email', $email)->get();
                                                                $IDpa = 0;
                                                                    foreach($IDs as $ID)
                                                                    {
                                                                        $IDpa=$ID->id;
                                                                        
                                                                    }
                                                                 $billsd=DB::select('select * from invoice WHERE `patient_ID` ='.$IDpa);
                                                                
                                                                    @endphp
                                                            @foreach ($billsd as $bill)
                                                                <tr>
                                                                       
                                                                        @php
                                                                        $id='no';
                                                                        $amont='no';
                                                                        $billsde=DB::select('select * from bill WHERE `invoice_id` ='.$bill->id);
                                                                
                                                                        foreach ($billsde as $billsd)
                                                                        {
                                                                            $id= $billsd->id;
                                                                            $amount= $billsd->amount;
                                                                        }
                                                                        @endphp
                                                                         @if($id!="no")
                                                                        <td></td>
                                                                    <td>{{ $id }}</td>
                                                                    <td>{{ $amount}}</td>
                                                                    <td>{{ $bill->remaining_amount }}</td>
                                                                    
                                                                    <td>
                                                                        <a class="btn btn-xs btn-primary" href="{{ route('patient.financial.showBill', [$id]) }}">
                                                                            <i class="fa fa-eye"></i>
                                                                        </a>
                                                                        
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>    
                                                </div>
                                            </div>
                                            
                                        
                            </div>
                          </div>
                @endsection