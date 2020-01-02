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
class FinancialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outcomes = Outcome::all();
        $incomes = Income::all();   
        $incomevalu=0;
        $outcomevalu=0;
        foreach($outcomes as $outcome)
        {
            $outcomevalu=  $outcomevalu+$outcome->amount;
        }
        foreach($incomes as $income)
        {
            $incomevalu= $incomevalu+$income->amount;
        }
        $profit= $incomevalu-$outcomevalu;
        return view('admin.financial.index', ['outcomes' => $outcomevalu, 'incomes' => $incomevalu,'profit' => $profit]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.financial.add');
    }
    
    public function indexbill()
    {
        $Invoices = Invoice::all();
      
        $bills = FinancialBillPayment::all();
        $patients=patient::all();
        return view('admin.financial.index_bill',['Invoices' => $Invoices],compact('bills'),['patients' => $patients]);
    }
    public function addbill()
    {
        $Invoices = Invoice::all();
        
        $bills = FinancialBillPayment::all();
        $patients=patient::all();
        return view('admin.financial.index_billindex',['Invoices' => $Invoices],compact('bills'),['patients' => $patients]);
    }
    
    public function billinvoicew(Invoice $invoice)
    {
        $patients=patient::all();
        return view('admin.financial.add_bill',['invoice' => $invoice],compact('patients'));
    }
    public function invoice()
    {
        $Invoices = Invoice::all();
        
        $patients=patient::all();
        return view('admin.financial.index_invoice',['Invoices' => $Invoices],compact('patients'));
    }
    public function addinvoice()
    {
        $patients=patient::all();
        return view('admin.financial.add_invoice',compact('patients'));
    }
    
    public function newinvoice(patient $patient)
    {
       
        return view('admin.financial.add_newinvoice',['patient' => $patient]);
    }

    
    public function newTinvoice(Invoiceval $request,Invoice $Invoices)
    {$did=null;
        $invoices=DB::select('select * from invoice ORDER BY id DESC LIMIT 1');
        $lastid=0;
        foreach($invoices as $invoice)
         {
             $lastid=$invoice->id;
             $did=$invoice->Did;
         }
         if($lastid==0)
         {
             $did="INV000";
         }
         $lastDid=substr($did,3);
         $lastDid=$lastDid+1;
         $lastDid=str_pad($lastDid,4,"0",STR_PAD_LEFT);
         $did="INV".$lastDid;
        
        $Invoices->amount = $request->get('amount');
        $Invoices->remaining_amount = $request->get('amount');
        $Invoices->patient_ID = $request->get('id');
        $Invoices->Did = $did;
        $Invoices->service=$request->get('Service');
        $Invoices->save();
        return view('admin.financial.success_invoice');
     }
    public function indexsalary()
    {
        $financials = FinancialSalaryPayment::all();
         $emp=Employee::all();
        
        return view('admin.financial.index_salary',['financials' => $financials],['emp' => $emp]);
    }
    
    public function addsalary(Employee $emp)
    {
        return view('admin.financial.add_salary',['emp' => $emp]);
    }
    
    public function indexother()
    {
        $otherpays = FinancialOtherPayment::all(); 
        return view('admin.financial.index_other',['otherPayments' => $otherpays]);
    }public function addother()
    {return view('admin.financial.add_other');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function stor(Bill $request,FinancialBillPayment $billw,Income $in)
    { 
        
        $bills= DB::table('invoice')->where('id', $request['inID'])->value('remaining_amount');
         $addam=$request['bi_am'];
        if($addam>$bills)
        {
            $message = 'Pyament  maximum ';
            return redirect()->intended(route('admin.financial.addbillinvoice', [$request['inID']]))->with('message', $message);
       
        }
        $lastid=0;
        $did=null;
        $billss=DB::select('select * from bill ORDER BY id DESC LIMIT 1');
        $bills=$bills-$addam;
        foreach($billss as $billes)
         {
             $lastid=$billes->id;
             $did=$billes->Did;
         }
         if($lastid==0)
         {
             $did="BIL000";
         }
         
         $lastDid=substr($did,3);
         $lastDid=$lastDid+1;
         $lastDid=str_pad($lastDid,4,"0",STR_PAD_LEFT);
         $did="BIL".$lastDid;
        
        
        DB::table('invoice')
        ->where('id', $request['inID'])
        ->update(['remaining_amount' =>$bills]);
        
        $in->amount=$request['bi_am'];
        $in->save();
        
        $billw->invoice_id=$request['inID'];
        $billw->empid=$request['empid'];
        $billw->amount=$request['bi_am'];
        $billw->Did = $did;
        $billw->save();
        
        return view('admin.financial.success_bill');
    }
    public function salary(Salary $request,Outcome $in,FinancialSalaryPayment $sala)
    { 
        // $lastid=0;
        // $did=null;
        // $billss=DB::select('select * from bill ORDER BY id DESC LIMIT 1');
       
        // foreach($invoices as $invoice)
        //  {
        //      $lastid=$invoice->id;
        //      $did=$invoice->Did;
        //  }
        //  if($lastid==0)
        //  {
        //      $did="PAY000";
        //  }
        //  $lastDid=substr($did,3);
        //  $lastDid=$lastDid+1;
        //  $lastDid=str_pad($lastDid,4,"0",STR_PAD_LEFT);
        //  $did="PAY".$lastDid;
        
        $in->amount=$request['emp_am'];
        $in->save();
         $request['date'];
        $sala->emp_id=$request['empid'];
        $sala->date=$request['date'];
        $sala->amount=$request['emp_am'];
        // $sala->Did = $did;
        $sala->save();
        // DB::insert('INSERT INTO `outcome` ( `amount`) VALUES  ( ?)',[ $request['emp_am']]);
        // DB::insert('INSERT INTO `salarypay` (`emp_name`, `date`, `amount`) VALUES  ( ?, ?, ?)',[$request['emp_name'], $now, $request['emp_am']]);
        return view('admin.financial.success_salary');
    }
    public function other(OtherPay $request,Outcome $in,Income $isn)
    { 
        $type=$request['oth_type'];

        if($type=="")
        {
            $message = 'Nothig select in payment type ';
            return redirect()->intended(route('admin.financial.add_other'))->with('message', $message);
        
        }
        if($type=="income")
        {
            $isn->amount=$request['oth_am'];
            $isn->save();
            DB::insert('INSERT INTO `otherpay` ( `descrption`,`type`, `amount`) VALUES   ( ?,?,?)',[$request['oth_note'],$request['oth_type'], $request['oth_am']]);
            return view('admin.financial.success_other');
        }
        else if($type=="outcome")
        {$in->amount=$request['oth_am'];
            $in->save();
        //DB::insert('INSERT INTO `outcome` ( `amount`) VALUES  ( ?)',[ $request['oth_am']]);
        DB::insert('INSERT INTO `otherpay` ( `descrption`,`type`, `amount`) VALUES   ( ?,?,?)',[$request['oth_note'],$request['oth_type'], $request['oth_am']]);
        return view('admin.financial.success_other');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Financial  $financial
     * @return \Illuminate\Http\Response
     */
    public function show(FinancialBillPayment $financialBill)
    {
        $invoiceid=$financialBill->invoice_id;
        $Invoices = Invoice::all();
        $patients=patient::all();
        $PId= DB::table('invoice')->where('id', $invoiceid)->value('patient_ID');
        $Pname= DB::table('patient')->where('id', $PId)->value('name');
        $array = array('name' => $Pname);
       
        return view('admin.financial.showBill', ['financialBill' => $financialBill],compact('patients'),compact('Invoices'))->with('array', $array);;
    }
    
    public function showinvoce(Invoice $Invoice)
    {
        $patients=patient::all();
        return view('admin.financial.showinvoice', ['Invoice' => $Invoice],compact('patients'));
    }
    public function showSalaryPayment(FinancialSalaryPayment $financialSalaryPayment) {
        $emp=Employee::all();
        return view('admin.financial.showSalary', ['financialSalaryPayment' => $financialSalaryPayment],compact('emp'));
    }

    public function showOtherPayment(FinancialOtherPayment $financialOtherPayment) {
        return view('admin.financial.showOtherPay', ['financialOtherPayment' => $financialOtherPayment]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Financial  $financial
     * @return \Illuminate\Http\Response
     */
    public function edit(FinancialBillPayment $financialBill)
    {
        return view('admin.financial.edit', ['financialBill' => $financialBill]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Financial  $financial
     * @return \Illuminate\Http\Response
     */
    public function update(BillIpdate $request)
    {
        $bills = DB::select('select * from bill where id ='.$request['id']);
        foreach($bills as $bill)
          {
              $patientname=$bill->patientname;
              $descrption=$bill->descrption;
                
              if(($patientname==$request['patientname']) and($descrption==$request['descrption']) )
              {
              $message = 'Nothing to update';
              return redirect()->intended(route('admin.financial.edit',[$bill->id]))->with('message', $message);
              }
              
          }
        DB::table('bill')
        ->where('id', $request['id'])
        ->update(['patientname' =>$request['patientname'],'descrption' =>$request['descrption']]);
        return view('admin.financial.success_bill');
    }

    //financial salary edit
    public function editSalary(FinancialSalaryPayment $financialSalary)
    {
        return view('admin.financial.edit_salary', ['financialSalary' => $financialSalary]);
    }
    public function updateSalary(Request $request)
    {
        DB::table('salarypay')
        ->where('id', $request['id'])
        ->update(['emp_name' =>$request['emp_name']]);
        return view('admin.financial.success_salary');
    }

    //financial otherpay edit
    public function editOtherPay(FinancialOtherPayment $financialOtherPay)
    {
        return view('admin.financial.edit_otherpay', ['financialOtherPay' => $financialOtherPay]);
    }
    public function updateOtherPay(OtherPayUpdate $request)
    {
        $other = DB::select('select * from otherpay where id ='.$request['id']);
        foreach($other as $others)
          {
              $descrption=$others->descrption;
                
              if(($descrption==$request['descrption']) )
              {
              $message = 'Nothing to update';
              return redirect()->intended(route('admin.financial.edit_otherpay',[$others->id]))->with('message', $message);
              }
              
          }
        if($type=="")
        {
            $message = 'Nothig select in payment type ';
            return redirect()->intended(route('admin.financial.add_other'))->with('message', $message);
        
        }
        DB::table('otherpay')
        ->where('id', $request['id'])
        ->update(['descrption' =>$request['descrption']]);
        return view('admin.financial.success_other');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Financial  $financial
     * @return \Illuminate\Http\Response
     */
    //delete salay record
    public function destroyRequest(FinancialSalaryPayment $financialSalary)
    {
        return view('admin.financial.delete', ['financialSalary' => $financialSalary]);
    }

    public function destroy(Request $request)
    {
        DB::table('salarypay')->where('id', $request['id'])->delete();
        return view('admin.financial.success_salary');
    }

    //delete bill record
    public function destroyBillRequest(FinancialBillPayment $financialBill)
    {
        return view('admin.financial.deleteBill', ['financialBill' => $financialBill]);
    }

    public function destroyBill(Request $request)
    {
        DB::table('bill')->where('id', $request['id'])->delete();
        return view('admin.financial.success_bill');
    }
    
    //delete other record
    public function destroyOtherPayRequest(FinancialOtherPayment $financialOtherPay)
    {
        return view('admin.financial.deleteOtherPay', ['financialOtherPay' => $financialOtherPay]);
    }

    public function destroyOtherPay(Request $request)
    {
        DB::table('otherpay')->where('id', $request['id'])->delete();
        return view('admin.financial.success_other');
    }
    
    public function addsalaryindex()
    {
        $financials = FinancialSalaryPayment::all();
        $emp=Employee::all();
        return view('admin.financial.add_salaryindex',['financials' => $financials],compact('emp'));
    }
    
    public function searchbill(Request $request)
    {
      
        $bills = DB::select('select * from bill where id ='.$request['search']);
        
        return view('admin.financial.index_bill',compact('bills'));
    }
    public function searchinvoice(Request $request)
    {
      
        $Invoices = DB::table('invoice')
        ->where('id', $request['search'])
        ->orWhere('patient_ID', 'like', '%' . $request['search'] . '%')
        ->orWhere('Did', 'like', '%' . $request['search'] . '%')
        ->get();
        $patients=patient::all();
        return view('admin.financial.index_invoice',['Invoices' => $Invoices],compact('patients'));
    
        return view('admin.financial.index_bill',compact('bills'));
    }
    
    public function searchbillin(Request $request)
    {
      
        
        $Invoices = DB::select('select * from invoice where id ='.$request['search']);
        
        $bills = FinancialBillPayment::all();
        $patients=patient::all();
        return view('admin.financial.index_billindex',['Invoices' => $Invoices],compact('bills'),['patients' => $patients]);
    
        return view('admin.financial.index_bill',compact('bills'));
    }
    public function incomereport()
    {

        return view('admin.financial.IncomeReport');
    }
    public function displayIncomeReport(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        //$sortBy = $request->input('sort_by');

        $title = 'Income Report'; // Report title

        $meta = [ // For displaying filters description on header
            'Registered on' => $fromDate . ' To ' . $toDate,

        ];

        $queryBuilder = income::select(['id','amount','created_at']) // Do some querying..
        ->whereBetween('created_at', [$fromDate, $toDate]);

        $columns = [ // Set Column to be displayed


            'Registered At' =>'created_at',
            'Total Balance' => 'amount',


        ];

        // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
        $title ="Report generation system updating";
        return  $title;
        return PdfReport::of($title, $meta, $queryBuilder, $columns)

            ->editColumns(['Registered At','Total Balance'], [ // Mass edit column
                'class' => 'right '
            ])
            ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                'Total Balance' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
            ])


            ->limit(20) // Limit record to be showed
            ->stream(); // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
    }
    public function Outcomereport()
    {

        return view('admin.financial.OutcomeReport');
    }

    public function displayOutcomeReport(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        //$sortBy = $request->input('sort_by');

        $title = 'Outcome Report'; // Report title

        $meta = [ // For displaying filters description on header
            'Registered on' => $fromDate . ' To ' . $toDate,

        ];

        $queryBuilder = outcome::select(['id','amount','created_at']) // Do some querying..
        ->whereBetween('created_at', [$fromDate, $toDate]);

        $columns = [ // Set Column to be displayed


            'Registered At' =>'created_at',
            'Total Balance' => 'amount',


        ];

        // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
        return PdfReport::of($title, $meta, $queryBuilder, $columns)

            ->editColumns(['Registered At','Total Balance'], [ // Mass edit column
                'class' => 'right '
            ])
            ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                'Total Balance' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
            ])


            ->limit(20) // Limit record to be showed
            ->stream(); // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
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
    public function printbill(Request $request)
    {
        $invoiceID= $request['inID'];
        $Billid= $request['id'];
        $billamount= $request['amount'];
        $patientID="no";
        $service="no";
        $remaining_amount="no";
        $patientname="no";
        $paddress="no";
        $paemail="no";
        $inamount="no";
        $invoicedetils = DB::select('select * from invoice where id ='.$invoiceID);
        foreach($invoicedetils as $detil)
          {
            $patientID=$detil->patient_ID;
            $service=$detil->service;
            $inamount=$detil->amount;
            $remaining_amount=$detil->remaining_amount;
          }
        $detils = DB::select('select * from patient where id ='.$patientID);
        foreach($detils as $detil)
          {
            $patientname=$detil->name;
            $paddress=$detil->address;
            $paemail=$detil->email;
          } 
          $services=DB::select("select * from service WHERE id = ".$service.";");
          foreach ($services as $servicee)
          {
              $service=$servicee->serviceName;
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
              font-size: 2.2em
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
                                  <div class="text-gray-light">INVOICE ID:'.$invoiceID.'</div>
                                  <div class="text-gray-light">BILL ID:'.$Billid.'</div>
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
                              <th class="text-right">INVOICE REMAINING AMOUNT</th>
                              <th class="text-right">BILL AMOUNT</th>
                          </tr>
                      </thead>
                      <tbody>
                          
                          <tr>
                              <td class="no">01</td>
                              <td class="text-left"><h3>'.$service.'</h3></td>
                              <td class="unit">RS.'.$inamount.'.00</td>
                              <td class="qty">RS.'.$remaining_amount.'.00</td>
                              <td class="total">RS.'.$billamount.'.00</td>
                          </tr>
                         
                      </tbody>
                      <tfoot>
                          <tr>
                              <td colspan="2"></td>
                              <td colspan="2">SUBTOTAL</td>
                              <td>RS.'.$billamount.'.00</td>
                          </tr>
                          <tr>
                              <td colspan="2"></td>
                              <td colspan="2">GRAND TOTAL</td>
                              <td>RS.'.$billamount.'.00</td>
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
