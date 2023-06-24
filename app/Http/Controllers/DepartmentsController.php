<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Patient;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $department = Department::all();

            $response['data']=$department;
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
        $department=Department::where('name',$request['name'])->first();
        if($department){
            $response['status']=0;
            $response['message']='Department Already Exist';
            $response['code']=409;
        }
        else{
            $department =Department::create($request->all());
            $response['status']=1;
            $response['message']='Department Created Successfully';
            $response['code']=200;

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
        $department = Department::find($id);
        if ($department) {
            $response['data']=$department;
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
            $department = Department::find($id);
            if(is_null($department)){
                $response['status'] = 1;
                $response['message'] = 'Patient Not Exist';
                $response['code'] = 409;
            }
            else{
                $department->update($request->all());
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
            $department = Department::findOrFail($id);
            $success =$department->delete();
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
}
