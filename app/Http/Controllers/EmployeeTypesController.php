<?php

namespace App\Http\Controllers;

use App\Models\EmployeeType;
use App\Models\InventoryType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class EmployeeTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $res = EmployeeType::get();


            $response['data']=$res;
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
        try {
            $employeeType=EmployeeType::where('name',$request['name'])->first();
            if ($employeeType) {
                $response['status'] = 0;
                $response['message'] = 'Already Exist';
                $response['code'] = 409;
            } else {
                $employeeType =  EmployeeType::create([
                    'name' => $request->name,

                ]);
                $response['status'] = 1;
                $response['message'] = 'Created Successfully';
                $response['code'] = 200;

            }
            return response()->json($response);

        }catch (QueryException $e){
            $response['data']=null;
            $response['code']=500;
            $response['message']='Error please ask admin';

            return response()->json( $response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res = EmployeeType::find($id);
        if ($res) {
            $response['data']=$res;
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
            $employeeType = EmployeeType::find($id);
            if (is_Null($employeeType)) {

                $response['status'] = 1;
                $response['message'] = 'Not Exist';
                $response['code'] = 409;
                return response()->json($response);

            } else {



                $employeeType->update($request->all());
                $response['status'] = 1;
                $response['message'] = 'Updated Successfully';
                $response['code'] = 200;
                return response()->json( $response);
            }

        } catch (QueryException $e) {
            $response['data'] = null;
            $response['message'] = 'Error pleas ask admin';
            $response['code'] = 500 ;
            $response['status'] = 0;
            return $response()->json( $response);

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
            $employee = EmployeeType::findOrFail($id);
            $success =$employee->delete();
            if($success){
                $response['status'] = 1;
                $response['message'] = 'Deleted Successfully';
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
