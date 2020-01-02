<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;


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
use App\Models\Service;
use App\Models\Quotation;
use App\Models\Quotations;
use App\Http\Requests\Serviceval;
use App\Http\Requests\Storeupdateval;
use App\Http\Requests\Serviceupdateval;


class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotations = Quotation::all();
        return view('admin.quotation.index', compact('quotations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quotation.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Quotation $Quotation)
    {
        $em=$request->service_type;
        $name="panding";
        $up="0";
        $did=null;
        $file=$request ->file('service_image');
       // DB::insert('INSERT INTO `limb-care`.`service` ( `serviceName`, `description`, `type`, `dataenterID`, `dataupdaterID`) VALUES ( ?, ?, ?, ? ,?)',
      //  [ $request['service_name'], $request['service_des'], $request['service_type'],$request['empID'],$request['it_type'],$up]);
        
        $quotations = DB::select('select * from quotations ORDER BY id DESC LIMIT 1');
       
        $lastid = 0;
        foreach($quotations as $quotation)
        {
            $lastid=$quotation->id;
            $did=$quotation->did;
        }
        if($lastid==0)
         {
             $did="QUT000";
         }
         $lastDid=substr($did,3);
         $lastDid=$lastDid+1;
         $lastDid=str_pad($lastDid,4,"0",STR_PAD_LEFT);
         $did="QUT".$lastDid;
         $lastid=$lastid+1;

        $Quotation->did = $did;
        $Quotation->date = $request->get('date');
        $Quotation->name = $request->get('pa_name');
        $Quotation->gender=$request->get('gender');
        $Quotation->pronounced=$request->get('pronounced');
        $Quotation->address = $request->get('address');
        $Quotation->divice = $request->get('divice');
        $Quotation->diagnosis=$request->get('diagnosis');
        $Quotation->prescription=$request->get('prescription');
        $Quotation->warranty=$request->get('warranty');
        $Quotation->deliverydate=$request->get('delivery');
        $Quotation->price=$request->get('price');
        $Quotation->pricevalidity=$request->get('price_v');
        $Quotation->paymentmethod=$request->get('payment_m');
        $Quotation->save();
        return view('admin.quotation.success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Quotation $quotation)
    {
        
        return view('admin.quotation.show',['Quotation' => $quotation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation)
    {
        return view('admin.quotation.edit',['Quotation' => $quotation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotation $quotation)
    {
        $quotations = DB::select('select * from quotations where id ='.$request['id']);
     
          foreach($quotations as $quotationes)
          {

                $date=$quotationes->date;
                $name=$quotationes->name;
                $address=$quotationes->address;
                $divice=$quotationes->divice;  
                $diagnosis=$quotationes->diagnosis;
                $prescription=$quotationes->prescription;
                $warranty=$quotationes->warranty;
                $deliverydate=$quotationes->deliverydate;  
                $price=$quotationes->price;
                $pricevalidity=$quotationes->pricevalidity;
                $paymentmethod=$quotationes->paymentmethod;
              if(($date==$request['date']) and ($name==$request['pa_name'])and($address==$request['address']) and ($divice==$request['divice'])and($diagnosis==$request['diagnosis']) and ($prescription==$request['prescription'])and($warranty==$request['warranty']) and ($deliverydate==$request['delivery'])and($price==$request['price']) and ($pricevalidity==$request['price_v']) and ($paymentmethod==$request['payment_m'])) 
              {
              $message = 'Nothing to update';
              return redirect()->intended(route('admin.quotation.edit',[$request->id]))->with('message', $message);
              }
          }
        //   $servicew->serviceName = $request->get('name');
        // $servicew->description = $request->get('discription');
        // $servicew->save();
        $nowtime = Carbon::now();
        DB::table('quotations')
            ->where('id', $request['id'])
            ->update(['date' => $request->get('date'),'name' => $request->get('pa_name'),'address'=>$request->get('address'),
            'divice'=>$request->get('divice'),'diagnosis'=>$request->get('diagnosis'),'prescription'=>$request->get('prescription'),
            'warranty'=>$request->get('warranty'),'deliverydate'=>$request->get('delivery'),'price'=>$request->get('price'),
            'pricevalidity'=>$request->get('price_v'),'paymentmethod'=>$request->get('payment_m')]);
        return view('admin.quotation.success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(Quotation $quotation)
    {
        return view('admin.quotation.delete',['Quotation' => $quotation]);
    }
    public function sedelete(Request $request)//Request $request, Employee $employee
    {
        DB::table('quotations')->where('id', $request['id'])->delete();
         return view('admin.quotation.success');
    }
    public function search(Request $request)//Request $request, Employee $employee
    {
        $quotations = DB::table('quotations')
        ->where('id', $request['search'])
        ->orWhere('name', 'like', '%' . $request['search'] . '%')
        ->orWhere('did', 'like', '%' . $request['search'] . '%')
        ->get();
        
        return view('admin.quotation.index', compact('quotations'));
        
    }
    public function print(Request $request)
    {
        $id= $request['id'];
        $quotations = DB::select('select * from quotations where id ='.$id);
        foreach($quotations as $quotation)
        {
            $did=$quotation->did;
            $date=$quotation->date;
            $pronounced=$quotation->pronounced;
            $gender=$quotation->gender;
            $name=$quotation->name;
            $address=$quotation->address;
            $divice=$quotation->divice;
            $diagnosis=$quotation->diagnosis;
            $prescription=$quotation->prescription;
            $warranty=$quotation->warranty;
            $deliverydate=$quotation->deliverydate;
            $price=$quotation->price;
            $pricevalidity=$quotation->pricevalidity;
            $paymentmethod=$quotation->paymentmethod;
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
                          <div>011 581 0059</div>
                          <div>info@artificiallimbcare.lk</div>
                      </div>
                  </div>
                  </div></div>
              </header>
              <main>
                  <div class="row contacts">
  
                      <div class="col invoice-to">
                          <div class="col-xs-12">
                            <div class="col-xs-12">   
                              
                                  <div class="text-gray-light">Quotation ID:'.$did.'</div>
                                  <div class="text-gray-light">Date:'.$date.'</div>
                                  <div class="text-gray-light">'. $pronounced.'.'.$name.'</div>
                                  <div class="address"><p align="justify">'.$address.'</p></div>
                                  <div class="text-gray-light">Dear '. $gender.',</div>
                                  <br>
                                  
                         
                                  
                            <div class="text-gray-light "><div style=" text-transform: uppercase;"><b><u>QUOTATIOn FOR '.$divice.'</u></b></div></div>
                        
                        <div class="text-gray-light "><b>As per quotation regarding the '.$divice.', we are
                            submitting the quotation for your ready reference. </b></div>
                            <br> <div class="text-gray-light"><b>Patient Name : '. $pronounced.'.'.$name.'</b></div>
                            <div class="text-gray-light"><b>Diagnosis : '. $diagnosis.'</b></div>
                            <div class="text-gray-light"><b>Prescription : '.$prescription.'</b></div>
                            <br>
                           
                            <div class="text-gray-light"><b>Warranty : '.$warranty.'. </b></div>
                            <div class="text-gray-light"><b>Delivery :'.$deliverydate.' </b></div>
                            <div class="text-gray-light"><b>Price Validity : '.$pricevalidity.'</b> </div>
                            <div class="text-gray-light"><b>Payment method :'. $paymentmethod.' </b></div>

                            <div class="text-gray-light"><b>Purchase Order to be issued to: Artificial limb care Pvt Ltd. </b></div>
                          
                            <div class="text-gray-light" style="padding-left: 15px;">• '.$divice.'=Rs.'.$price.'</div>
                            <div class="text-gray-light"><b>Fitment and ADL Training Charges : Free of Charge</b></div>
                            <br>
                            <div class="text-gray-light">We hope that the above information is enough to meet your requirement, if you need any further
                                clarification please feel free to contact the undersigned.  </div>
                            <br>
                            <div class="text-gray-light">Assuring you of our best service at all time.</div>
                          
                            <br>
                            <div class="text-gray-light">Thank You,</div>
                            <div class="text-gray-light">Yours Faithfully,</div>
                            <br>
                            <div class="text-gray-light">....................</div>
                            <div class="text-gray-light">Buddika Asanka</div>
                            <div class="text-gray-light">CEO Artificial limb care (Pvt) Ltd, </div>
                            <div class="text-gray-light">Prosthetics & Orthotics BSc ISPO Cat 1</div>

           
                                  
                                
                              
                        </div>
                      </div>
                   </div>
                   </main>
                  </div></div>
  
          </body>
          </html>');
          return $pdf->stream();
      }

}
