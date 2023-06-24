<?php

namespace App\Http\Controllers;

use App\Models\OutPatient;
use App\Models\Patient;
use App\Models\PatientAppointmentModel;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $patients = Patient::select("*")
                ->orderBy('created_at', 'desc')
                ->get();

                $response['data']=$patients;
                $response['status'] = 1;
                $response['message'] = 'Success';
                $response['code'] = 200;
            return view('dashboard.patients.index',compact('patients'));

        }catch (QueryException $e){
            $response['data']=null;
            $response['code']=500;
            $response['message']='Error';

            return response()->json( $response);
        }
        //
    }


    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data= Patient::select('*')->get();
            return Datatables::of($data)
                ->make(true);
        }
        $columns = ['first_name','last_name'];
        if ($request->ajax()) {
            $query = Patient::select('*');

            if ($request->search_query != "") {
                //dd("srfegv");
                //echo 'd';exit();
                $whereCluase = "( ";
                foreach ($columns as $column) {
                    $whereCluase .=  $column . " LIKE '%" . $this->search_query . "%' OR ";
                }
                //delete last OR in whereCluause
                $whereCluase = substr($whereCluase, 0, strlen($whereCluase) - 3) . " )";
                $query = $query->whereRaw(DB::raw($whereCluase));

                $recordsFiltered = $query->count('*');
                return $this;
            }

            return DataTables::of($query)
                ->make(true);
        }
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

    public function getAppointments($id){
        $all_today_appointments = PatientAppointmentModel::whereDate('appointment_time', Carbon::today())->count();
        if($all_today_appointments < 20){
            $patient = Patient::find($id);
            return view('dashboard.patients.appointments',compact('patient','all_today_appointments'));
        }
    }

    public function setAppointment($patient_id , $appointment_id){
        $this_patient_appointment = PatientAppointmentModel::where('patient_id',$patient_id)->whereDate('appointment_time', Carbon::today())->first();
        if($this_patient_appointment){
            $response['data']=$this_patient_appointment;
            $response['status'] = 1;
            $response['message'] = "المريض موجود سابقاً بهذا الحجز" ;
            $response['code'] = 200;
            return response()->json( $response);
        }
        else{
            PatientAppointmentModel::create([
                'patient_id' => $patient_id,
                'appointment_time' => Carbon::now()->addHour(),
                'payment_time' => null,
            ]);

            return redirect()->route('get_patients');
        }

    }

    public function getTemporaryAppointments(){
        $temporary_appointments = PatientAppointmentModel::where('is_paid',0)->whereDate('appointment_time', Carbon::today())->get();
        return view('dashboard.patients.temporary_appointments',compact('temporary_appointments'));

    }

    public function paid($appointment_id){
        $appointment = PatientAppointmentModel::find($appointment_id);
        $appointment->is_paid = 1;
        $appointment->is_temporary = 0;
        $appointment->payment_time = Carbon::now();
        $appointment->save();
        return redirect()->back();
    }

    public function today_appointments(){
        $patients_appointments = PatientAppointmentModel::where('is_paid',1)->where('is_temporary',0)->whereDate('appointment_time', Carbon::today())->orderby('appointment_time','Asc')->get();
        return view('dashboard.patients.doctor',compact('patients_appointments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
                $patient = Patient::where('national_number', $request['national_number'])->first();


            $patient2 = Patient::where([
                ['first_name', '=', $request['first_name']],
                ['father_name', '=', $request['father_name']],
                ['last_name', '=', $request['last_name']],
                ['mother_name', '=',$request['mother_name']],
                ['birth_date', '=', $request['birth_date']],
            ])->first();





            if ($patient||$patient2) {
                $response['status'] = 0;
                $response['message'] = 'Patient Already Exist';
                $response['code'] = 409;
            } else {
//                $patient = Patient::create([
//                    'first_name' => $request->first_name,
//                    'father_name' => $request->father_name,
//                    'last_name' => $request->last_name,
//                    'mother_name' => $request->mother_name,
//                    'birth_place' => $request->birth_place,
//                    'birth_date' => $request->birth_date,
//                    'city' => $request->city,
//                    'code' => $request->code,
//                    'gender' => $request->gender,
//                    'address' => $request->address,
//                    'national_number' => $request->national_number,
//                    'identity_number' => $request->identity_number,
//                    'hospital_number' => $request->hospital_number,
//                ]);
                $patient =Patient::create($request->all());
                $response['status'] = 1;
                $response['message'] = 'Patient Created Successfully';
                $response['code'] = 200;

            }
            return response()->json($response);

        }catch (QueryException $e){
            $response['data']=null;
            $response['code']=500;
            $response['message']='Error please ask admin '.$e;

            return response()->json( $response);
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $patient = Patient::find($id);
            if ($patient) {
                $response['data'] = $patient;
                $response['status'] = 1;
                $response['message'] = 'Success';
                $response['code'] = 200;
                return response()->json($response);
            } else {
                $response['data'] = null;
                $response['code'] = 404;
                $response['message'] = 'Not Found';
                return response()->json($response);
            }
        }
        catch (QueryException $e){
            $response['status'] = 0;
            $response['data']=null;
            $response['code']=500;
            $response['message']='Error pleas ask admin';

            return response()->json( $response);
        }
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request,$id)
    {
        try {
            $patient = Patient::find($id);
            if(is_null($patient)){
                $response['status'] = 1;
                $response['message'] = 'Patient Not Exist';
                $response['code'] = 409;
            }
            else{
                $patient->update($request->all());
                $response['status'] = 1;
                $response['message'] = 'Patient Updated Successfully';
                $response['code'] = 200;
            }
            return response()->json($response);

        }catch (QueryException $e){
            $response['status'] = 0;
            $response['data']=null;
            $response['code']=500;
            $response['message']='Error pleas ask admin';

            return response()->json( $response);
        }



        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        try {
            $patient = Patient::findOrFail($id);
            $success =$patient->delete();
            if($success){
                $response['status'] = 1;
                $response['message'] = 'Patient Deleted Successfully';
                $response['code'] = 200;
                return response()->json($response);
            }
            else{
                $response['status'] = 0;
                $response['message'] = 'Error';
                $response['code'] = 500;
                return response()->json($response);
            }


        }catch (QueryException $e){
            $response['data']=null;
            $response['code']=500;
            $response['message']='Error';
            return response()->json( $response);
        }


        //
    }


    public function searchByName(Request $request)
    {
        if($request->last_name==null)
        {
            try {
                $res = Patient::where('first_name',$request->first_name)
//                    ->where('last_name',$request->last_name)
                    ->get();
                if ($res) {
                    $response['data']=$res;
                    $response['status'] = 1;
                    $response['message'] = 'Success';
                    $response['code'] = 200;
                    return response()->json($response);
                }
                else{
                    $response['data']=null;
                    $response['status'] = 0;
                    $response['message'] = 'Not Found';
                    $response['code'] = 409;
                    return response()->json($response);
                }
            }catch (QueryException $e){
                $response['data']=null;
                $response['code']=500;
                $response['message']='Error';
                return response()->json( $response);
            }
        }
        else
        {
            try {
                $res = Patient::where('first_name',$request->first_name)
                    ->where('last_name',$request->last_name)
                    ->get();
                if ($res) {
                    $response['data']=$res;
                    $response['status'] = 1;
                    $response['message'] = 'Success';
                    $response['code'] = 200;
                    return response()->json($response);
                }
                else{
                    $response['data']=null;
                    $response['status'] = 0;
                    $response['message'] = 'Not Found';
                    $response['code'] = 409;
                    return response()->json($response);
                }
            }catch (QueryException $e){
                $response['data']=null;
                $response['code']=500;
                $response['message']='Error';
                return response()->json( $response);
            }
        }

    }
    public function searchByNationalNumber(Request $request)
    {
        try {
            $res = Patient::where('national_number',$request->national_number)
                ->get();
            if ($res) {
                $response['data']=$res;
                $response['status'] = 1;
                $response['message'] = 'Success';
                $response['code'] = 200;
                return response()->json($response);
            }
            else{
                $response['data']=null;
                $response['status'] = 0;
                $response['message'] = 'Not Found';
                $response['code'] = 409;
                return response()->json($response);
            }
        }catch (QueryException $e){
            $response['data']=null;
            $response['code']=500;
            $response['status'] = 0;
            $response['message']='Error '.$e;
            return response()->json( $response);
        }
    }

    public function searchByHospitalNumber(Request $request)
    {
        try {
            $res = Patient::where('hospital_number',$request->hospital_number)
                ->get();
            if ($res) {
                $response['data']=$res;
                $response['status'] = 1;
                $response['message'] = 'Success';
                $response['code'] = 200;
                return response()->json($response);
            }
            else{
                $response['data']=null;
                $response['status'] = 0;
                $response['message'] = 'Not Found';
                $response['code'] = 409;
                return response()->json($response);
            }
        }catch (QueryException $e){
            $response['data']=null;
            $response['code']=500;
            $response['status'] = 0;
            $response['message']='Error '.$e;
            return response()->json( $response);
        }
    }
    public function select(Request $request)
    {
      $page        = $request->get('page');
      $offset      = ($page - 1) * 10;
      $data        = Patient::select('id', 'first_name','last_name');

      if($request->term != null){
        $data = $data->where(function($query) use($request){
          $query =	$query->whereRaw( DB::raw( "LOWER(first_name) LIKE '%".$request->term."%'") )  ;
        });
      }




      $totalRows =  $data->count();
      $lastRow   =  $offset + 10;
      $morePages =  $lastRow < $totalRows;
      $data      =  $data->orderBy('id')->skip($offset)->take(10)->get();

      $results = [
        "results"    => $data->map(function($item){
          return [
            "id"   =>  $item['id'] ,
            "text" =>  ($item['id'] ." ".$item['first_name'] ." ".$item['last_name']),
          ];
        }),
        "pagination" => ["more" => $morePages ]
      ];

      return response()->json($results);
    }
}
