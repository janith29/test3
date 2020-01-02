<?php

namespace App\Http\Controllers\Admin;

use App\Models\FinancialSalaryPayment;
use App\Models\FinancialBillPayment;
use App\Models\FinancialOtherPayment;
use App\Models\Outcome;
use App\Models\Income;
use App\Models\Patient;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use DateTime;
use PdfReport;
use App\Models\Employee;
use App\Http\Requests\Bill;
use App\Http\Requests\BillIpdate;
use App\Http\Requests\Invoiceval;
use App\Http\Requests\Salary;
use App\Http\Requests\Salarypdate;
use App\Http\Requests\OtherPay;
use App\Http\Requests\OtherPayUpdate;
use App;
use Barryvdh\DomPDF\Facade as PDF;
class FinancialbillController extends Controller
{
   
    public function searchbill(Request $request)
    {
        $Invoices = Invoice::all();
      
        $patients=patient::all();
        $bills = DB::select('select * from bill where id ='.$request['search']);
        return view('admin.financial.index_bill',['Invoices' => $Invoices],compact('bills'),['patients' => $patients]);
 
    }
    public function searchpatientin(Request $request)
    {
        $patients = DB::table('patient')
        ->where('id', $request['search'])
        ->orWhere('name', 'like', '%' . $request['search'] . '%')
        ->orWhere('nic', 'like', '%' . $request['search'] . '%')
        ->get();
        return view('admin.financial.add_invoice',compact('patients'));
       
    }

    public function printinvoice(Request $request)
    {
        
        $invoiceID=$request['inID'];
        $patintid=$request['patintID'];
        $reamount=$request['reamount'];
        $service=$request['service'];
        $amount=$request['amount'];
        $paid=$amount-$reamount;
        $patientname="no";
        $paddress="no";
        $paemail="no";
        $invoicedetils = DB::select('select * from invoice where id ='.$invoiceID);
        foreach($invoicedetils as $detil)
          {
            $patientID=$detil->patient_ID;
            $service=$detil->service;
            $inamount=$detil->amount;
            $remaining_amount=$detil->remaining_amount;
          }
        $services=DB::select("select * from service WHERE id = ".$service.";");
        foreach ($services as $servicet)
        {
            $service=$servicet->serviceName;
        }
        $detils = DB::select('select * from patient where id ='.$patintid);
        foreach($detils as $detil)
          {
            $patientname=$detil->name;
            $paddress=$detil->address;
            $paemail=$detil->email;
          }
        $pdf=App::make('dompdf.wrapper');
        $pdf->loadHTML('<!DOCTYPE html>
        <html>
        <head>
                <link rel="icon" href="http://artificiallimbcare.lk/img/core-img/favicon.png" type="image" sizes="16x16">
                <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <style>
       
        
        .invoice {
            position: relative;
            background-color: #FFF;
            padding: 15px;
            
        }
        
        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #3989c6
        }
        
        .invoice .company-details {
            text-align: right
        }
        
        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }
        
        .invoice .contacts {
            margin-bottom: 20px
        }
        
        .invoice .invoice-to {
            text-align: left
        }
        
        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }
        
        .invoice .invoice-details {
            text-align: right
        }
        
        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #3989c6
        }
        
        .invoice main {
            padding-bottom: 20px
        }
        
        .invoice main .thanks {
            margin-top: -100px;
            font-size: 2em;
            margin-bottom: 50px
        }
        
        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #3989c6
        }
        
        .invoice main .notices .notice {
            font-size: 1.2em
        }
        
        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }
        
        .invoice table td,.invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff
        }
        
        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }
        
        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #3989c6;
            font-size: 1.2em
        }
        
        .invoice table .qty,.invoice table .total,.invoice table .unit {
            text-align: right;
            font-size: 1.2em
        }
        
        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #3989c6
        }
        
        .invoice table .unit {
            background: #ddd
        }
        
        .invoice table .total {
            background: #3989c6;
            color: #fff
        }
        
        .invoice table tbody tr:last-child td {
            border: none
        }
        
        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }
        
        .invoice table tfoot tr:first-child td {
            border-top: none
        }
        
        .invoice table tfoot tr:last-child td {
            color: #3989c6;
            font-size: 1.4em;
            border-top: 1px solid #3989c6
        }
        
        .invoice table tfoot tr td:first-child {
            border: none
        }
        
        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }
        .back{
            background-repeat: no-repeat; 
            background-position: left; 
            background-image: url(http://artificiallimbcare.lk/img/core-img/size200pxartificial.png); 
           
        }
        .fo{
            bottom: 10px;
            position: absolute;
        }
        @media print {
            .invoice {
                font-size: 11px!important;
                overflow: hidden!important
            }
        
            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }

        </style>
        </head>
        <body>
        <!--Author      : @arboshiki-->
        <div class="container">
<div id="invoice">

    
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header class="back">
                <div class="row">
                    <div class="col-xs-5 col-sm-6 col-lg-4">
                       
                    </div>
                    <div class="col-xs-7 col-sm-6 col-lg-8 company-details">
                        <h2 class="name">
                            <a target="_blank" href="http://artificiallimbcare.lk">
                                Artificial limb care (Pvt) Ltd.
                            </a>
                        </h2>
                        <div>No 4, Mithrananda Mawatha,</div>
                                <div> Kiribathgoda.</div>
                        <div>071 345 0257</div>
                        <div>info@artificiallimbcare.lk</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">

                    <div class="col invoice-to">
                        <div class="col-xs-12">
                            <div class="col-xs-4">
                                <div class="text-gray-light">INVOICE TO:'.$invoiceID.'</div>
                                <h2 class="to">'. $patientname.'</h2>
                                <div class="address"><p align="justify">'.$paddress.'</p></div>
                                <div class="email"><a href="mailto:'.$paemail.'">'.$paemail.'</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                    <div class="col invoice-details">
                        
                            <h1 class="invoice-id">INVOICE 3-2-1</h1>
                            <div class="date">Date of Invoice: 01/10/2018</div>
                        </div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th># </th>
                            <th class="text-left">SERVICE</th>
                            <th class="text-right">INVOICE AMOUNT</th>
                            <th class="text-right">TOTAL PAID AMOUNT</th>
                            <th class="text-right">REMAINING AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <td class="no">01</td>
                            <td class="text-left"><h3>'.$service.'</h3></td>
                            <td class="unit">RS.'.$amount.'.00</td>
                            <td class="qty">RS.'.$paid.'.00</td>
                            <td class="total">RS.'.$reamount.'.00</td>
                        </tr>
                       
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td>RS.'.$reamount.'.00</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>RS.'.$reamount.'.00</td>
                        </tr>
                    </tfoot>
                </table>
                <br> <br> <br> <br>
                <div style=" bottom: 10px; position: static;"><h2>Thank you for your Business...!</h2></div>
               
                <div class="container fo" >
                <div class="col-xs-6">
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">It’s been a pleasure working with you…!</div>
                </div> </div>
                <div align="left" >
                        <p style="text-align:right">………………………………</p>
                        <h4 style="text-align:right">Authorized By</h4>
                        </div>
        
                <div class="col-xs-4 ">
                        
                    </div>
                    <br>
                    
						</div>
            </div>
            </main>
            <br>
            <footer>
                Invoice was created on a computer and is valid without the signature and seal.
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div></div>

        </body>
        </html>
        ');
        return $pdf->stream();
    }
}
