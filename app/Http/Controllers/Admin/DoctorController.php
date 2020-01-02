<?php

namespace App\Http\Controllers\Admin;
use App\Models\Patient;
use Charts;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Validator;
use PdfReport;
use Carbon\Carbon;
use App\Models\Auth\Role\Role;
use App\Models\Auth\User\User;
use Ramsey\Uuid\Uuid;


class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = doctor::all();

        return view('admin.doctors.index', compact('doctors'));
    }
    public function add()
    {
        return view('admin.doctors.add');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response66
     */
    public function create(Request $request,Doctor $doctor)
    {
        $lastid=0;
        $name="panding";
        //check for duplicate
        Validator::extend('uniqueDoctorCheck', function ($attribute, $value, $parameters, $validator) {
            $count = DB::table('users')->where('email', $value)->count();

            return $count === 0;
        });
        
        
        // $validatedData = $request->validate([

        //     'name'     => 'required|regex:/^[\pL\s\-]+$/u',
        //     //'nic' => 'required|regex:/[0-9]{9}[V-v]/',
        //     //'address' => 'required',
        //     'doc_pic' => 'required',
        //     'hospital' => 'required|regex:/^[\pL\s\-]+$/u',


        //     'email' => 'required|email',

        //     //'mobile' => 'required|min:11|numeric',
        //     'mobile' => 'required|regex:/(0)[0-9]{9}/',
        //     'email' => "uniqueDoctorCheck:{$request->email}"

        //     // 'birthday' => 'required'
        // ]);

        $validatedData =[
            'name'     => 'required|regex:/^[\pL\s\-]+$/u',
            //'nic' => 'required|regex:/[0-9]{9}[V-v]/',
            //'address' => 'required',
            'doc_pic' => 'required',
            'hospital' => 'required|regex:/^[\pL\s\-]+$/u',


            'email' => 'required|email',

            //'mobile' => 'required|min:11|numeric',
            'mobile' => 'required|regex:/(0)[0-9]{9}/',
            'email' => "uniqueDoctorCheck:{$request->email}"

        ];
        $customMessages = [
            'unique_doctor_check' => 'This email already in the system'
        ];
        $this->validate($request, $validatedData, $customMessages);
        $time =Carbon::now()->format('Y-m-d H:i:s');
        $file=$request ->file('doc_pic');

        $doctor=DB::select('select * from Doctors ORDER BY id DESC LIMIT 1');

        $type=$file->guessExtension();
        foreach($doctor as $doc)
        {
            $lastid=$doc->id;
            $did=$doc->Did;
        }
        if($lastid==0)
         {
            $did="DOC000";
         }
         $lastDid=substr($did,3);
         $lastDid=$lastDid+1;
         $lastDid=str_pad($lastDid,4,"0",STR_PAD_LEFT);
         $did="DOC".$lastDid;
         $lastid=$lastid+1;
        $name=$lastid."pic.".$type;
        $file->move('image/doc/profile',$name);



        DB::insert('INSERT INTO `doctors` (`name`,`email`,`hospital`,`Did`,`mobile`,`doc_pic`,`created_at`) VALUES  ( ?,?,?,?,?,?,?)' ,[$request['name'], $request['email'], $request['hospital'],$did,$request['mobile'],$name,$time]);


        //attach the role to login in to correct dashboard
        $role = Role::findOrFail(6);

        //insert newly added doctor into user table to login and and other things
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('mobile')),
            'confirmation_code' => Uuid::uuid4(),
            'confirmed' => true,
            'usertype' => 'Doctor'
        ]);

        // assign the role to a user role.
        $user->roles()->attach($role);
        
        return redirect()->route('admin.doctors')->with('message', 'Doctor added successfully!');

    }

    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public $timestamps = false;

    public function show( Doctor $doctor)
    {
        return view('admin.doctors.show',['doctor' => $doctor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor, Request $request)//
    {
        return view('admin.doctors.edit',['doctor' => $doctor]);

     }

    public function delete(Request $request, Doctor $doctor)//Request $request, Employee $employee
    {

    }



    public function update(Request $request, Doctor $doctor)
    {
        // $validatedData = $request->validate([
        //     'name'     => 'required|regex:/^[\pL\s\-]+$/u',
        //     'hospital' => 'required|regex:/^[\pL\s\-]+$/u',
        //     'email' => 'required|email',
        //     'mobile' => 'required|regex:/(0)[0-9]{9}/'

        // ]);
        Validator::extend('uniqueDoctorCheck', function ($attribute, $value, $parameters, $validator) {
            $count = DB::table('users')->where('email', $value)->count();
        
            return $count === 0;
        });

        $validatedData =[
            'name'     => 'required|regex:/^[\pL\s\-]+$/u',
            'hospital' => 'required|regex:/^[\pL\s\-]+$/u',
            'mobile' => 'required|regex:/(0)[0-9]{9}/'

        ];
        $customMessages = [
            'unique_doctor_check' => 'This email already in the system'
        ];
        $this->validate($request, $validatedData, $customMessages);
        $doctor->name = $request->get('name');
        $doctor->hospital = $request->get('hospital');
        $doctor->mobile = $request->get('mobile');

        $doctor->save();
     $message = 'Successfully updated doctor named '.$doctor->name.' with id '.$doctor->id;
        return redirect()->intended(route('admin.doctors'))->with('message',$message);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $message = 'Successfully deleted doctor named :- '.$doctor->name.' with ID :-'.$doctor->id;
        
        //delete doctor record from users table
        $user = DB::table('doctors')->where('email',$doctor->email)->delete();

        $doctor->delete();

        return redirect()->route('admin.doctors')->with('message', $message);
    }

    public function report(){
        $counts = [
            'Doctors' => DB::table('doctors')->count(),
            'hospital' => DB::table('doctors')
                ->select('*')
                ->DISTINCT('hospital')
                ->count( 'hospital')

        ];

        return view('admin.doctors.report',['counts' => $counts]);

    }
    public function displayReport(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $sortBy = $request->input('sort_by');

        $title = 'Registered Doctor Report'; // Report title

        $meta = [ // For displaying filters description on header
            'Registered on' => $fromDate . ' To ' . $toDate,
            'Sort By' => $sortBy
        ];

        $queryBuilder = doctor::select(['id','created_at','name', 'email','mobile','hospital']) // Do some querying..
        ->whereBetween('created_at', [$fromDate, $toDate]);

        $columns = [ // Set Column to be displayed

            'Name' => 'name',
            'Registered At' =>'created_at', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
            'Hospital' => 'hospital',
            'Email' => 'email',
            'Mobile' =>'mobile'


        ];

        // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
        return PdfReport::of($title, $meta, $queryBuilder, $columns)

            ->editColumns(['Registered At','Name','Hospital','Email','Mobile'], [ // Mass edit column
                'class' => 'right '
            ])

            ->limit(20) // Limit record to be showed
            ->stream(); // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
    }
    public function chartjs(){

    }
    public function search(Request $request){

        $searchname =  $request->get('q');
        $Doctors = Doctor::where('name','LIKE','%'.$searchname.'%')->orWhere('id','LIKE','%'.$searchname.'%')->get();
       
            return view('admin.Doctors.index')->withDoctors($Doctors)->withQuery ( $searchname );
    }

}
