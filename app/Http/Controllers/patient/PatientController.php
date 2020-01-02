<?php

namespace App\Http\Controllers\patient;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\FinancialBillPayment;
use App\Models\Invoice;
class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('patient.patients.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function patientint()
    {
        return view('patient.diagnosis.index');
    }

    
    public function doctors()
    {
        return view('patient.doctors.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function servicesi()
    {
        $services = Service::all();
        return view('patient.services.index', compact('services'));
    }
    public function searchservice(Request $request )
    {
        $requeid=$request->searchservice;
        $services = DB::table('service')->where('id', $requeid)->orWhere('serviceName', 'like', '%' . $requeid . '%')->get();
      
        return view('patient.services.index',compact('services'));
    }
    /** 
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function quindex()
    {
        return view('patient.question_forum.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        //financialinvoice
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function financial(Request $request)
    {
        return view('patient.financial.index');
    }
    public function financialinvoice(Invoice $Invoice)
    {
        $patients=patient::all();
        return view('patient.financial.showinvoice',['Invoice' => $Invoice],compact('patients'));
    }
    public function showinvoce(Invoice $Invoice)
    {
        $patients=patient::all();
        return view('patient.financial.showinvoice', ['Invoice' => $Invoice],compact('patients'));
    }
    public function financialbill(FinancialBillPayment $financialBill)
    {
      
        $invoiceid=$financialBill->invoice_id;
        $Invoices = Invoice::all();
        $patients=patient::all();
        $PId= DB::table('invoice')->where('id', $invoiceid)->value('patient_ID');
        $Pname= DB::table('patient')->where('id', $PId)->value('name');
        $array = array('name' => $Pname);
       
        return view('patient.financial.showBill', ['financialBill' => $financialBill],compact('patients'),compact('Invoices'))->with('array', $array);;
    }
}
