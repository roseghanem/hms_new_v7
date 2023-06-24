<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Patient;
use App\Models\PatientDepartmentIntrance;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PatientDepartmentIntrancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $patientDepartmentIntrance = PatientDepartmentIntrance::with([
                'department:id,name','patient:id,first_name,father_name,last_name'
            ])->orderBy('created_at', 'desc')
                ->get();

            $response['data']=$patientDepartmentIntrance;
            $response['status'] = 1;
            $response['message'] = 'Success';
            $response['code'] = 200;
            return response()->json($response);

        }catch (QueryException $e){
            $response['data']=null;
            $response['code']=500;
            $response['message']='Error';

            return response()->json( $response);
        }
        //
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
    public function store(Request $request)
    {

        $res=PatientDepartmentIntrance::where('visit_date',$request['visit_date'])
            ->where('patient_id',$request['patient_id'])
            ->where('department_id',$request['department_id'])
            ->first();

        if($res){
            $response['status']=0;
            $response['message']='لا يمكنك تسجيل زيارة لنفس المريض ونفس القسم بنفس التاريخ';
            $response['code']=409;
        }
        else{
            try {

                $patientDepartmentIntrance =PatientDepartmentIntrance::create($request->all());
                $response['status']=1;
                $response['message']='تم تسجيل الزيارة بنجاح';
                $response['code']=200;
            }
            catch (QueryException $e){
                $response['status'] = 0;
                $response['data']=null;
                $response['code']=500;
                $response['message']='Error pleas ask admin';
            }
        }
        return response()->json( $response);
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
        $patientDepartmentIntrance = PatientDepartmentIntrance::
        with(['department:id,name','patient:id,first_name,father_name,last_name'])
            ->find($id);
        if ($patientDepartmentIntrance) {
            $response['data']=$patientDepartmentIntrance;
            $response['status'] = 1;
            $response['message'] = 'Success';
            $response['code'] = 200;
            return response()->json($response);
        }
        else{
            $response['data']=null;
            $response['code']=404;
            $response['message']='Not Found';
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
    public function update(Request $request, $id)
    {

        try {
            $patientDepartmentIntrance = PatientDepartmentIntrance::findOrFail($id);
            if(is_null($patientDepartmentIntrance)){
                $response['status'] = 1;
                $response['message'] = 'Patient Intrance Not Exist';
                $response['code'] = 409;
            }
            else{
                $patientDepartmentIntrance->update($request->all());
                $response['status'] = 1;
                $response['message'] = 'Patient Intrance Updated Successfully';
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
            $patientDepartmentIntrance = PatientDepartmentIntrance::findOrFail($id);
            $success =$patientDepartmentIntrance->delete();
            if($success){
                $response['status'] = 1;
                $response['message'] = 'Patient Intrance Created Successfully';
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


        try {
            $patient=Patient::where('first_name',$request->first_name)
                ->where('last_name',$request->last_name)
                ->first();
            if($patient)
            {
                $res = PatientDepartmentIntrance::where('patient_id',$patient['id'])
                    ->with(['department:id,name','patient:id,first_name,father_name,last_name'])
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
            }
            else
            {
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



    public function searchByDate(Request $request)
    {
        try {
            $res = PatientDepartmentIntrance::where('visit_date',$request->visit_date)
            ->with(['department:id,name','patient:id,first_name,father_name,last_name'])
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






    public function searchByNumber(Request $request)
    {


        try {
            $patient=Patient::where('hospital_number',$request->hospital_number)
                ->first();
            if($patient)
            {
                $res = PatientDepartmentIntrance::where('patient_id',$patient['id'])
                    ->with(['department:id,name','patient:id,first_name,father_name,last_name'])
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
            }
            else
            {
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

}
