<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $res = Driver::select("*")
                ->orderBy('created_at', 'desc')
                ->get();
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

        $this->validate($request, array(
            'name' => 'required',
            'national_number'  => 'required',
            'phone'  => 'required',
        ));
        $driver=Driver::where('national_number',$request->national_number)->first();
        if($driver){
            $response['data']=null;
            $response['status']=0;
            $response['message']='Driver Already Exist';
            $response['code']=409;
        }
        else{
            try {
                $new_driver = new  Driver();
                //Set Car Details
                $new_driver->name = $request->name;
                $new_driver->national_number = $request->national_number;
                $new_driver->phone = $request->phone;
                $new_driver->save();
                $response['data']=$new_driver;
                $response['status']=1;
                $response['message']='Driver Created Successfully';
                $response['code']=200;
            }
            catch (\Exception $ex){

                $response['data']=null;
                $response['status']=1;
                $response['message']='Error Please Ask Admin';
                $response['code']=500;
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
        try {
            $res =Driver::find($id);
            if($res)
            {

                $response['data']=$res;
                $response['status'] = 1;
                $response['message'] = 'Success';
                $response['code'] = 200;
                return response()->json($response);
            }
            else
            {

                $response['data']=null;
                $response['status'] = 1;
                $response['message'] = 'Not Found';
                $response['code'] = 200;
                return response()->json($response);
            }

        }catch (QueryException $e){
            $response['data']=null;
            $response['code']=500;
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
        $this->validate($request, array(
            'name' => 'required',
            'national_number'  => 'required',
            'phone'  => 'required',
        ));
        $driver=Driver::find($id);
        if($driver){
            try {
                //Set Car Details
                $driver->name = $request->name;
                $driver->national_number = $request->national_number;
                $driver->phone =$request->phone;
                $driver->save();
                $response['data']=$driver;
                $response['status']=1;
                $response['message']='Driver Updated Successfully';
                $response['code']=200;
            }
            catch (\Exception $ex){

                $response['data']=null;
                $response['status']=1;
                $response['message']='Error Please Ask Admin';
                $response['code']=500;
            }
        }
        else{

            $response['data']=null;
            $response['status']=0;
            $response['message']='Driver Not Exist';
            $response['code']=409;
        }
        return response()->json( $response);

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
            $driver = Driver::findOrFail($id);
            $success =$driver->delete();
            if($success){
                $response['status'] = 1;
                $response['message'] = 'Driver Deleted Successfully';
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
            $response['message']='Error please ask admin';
            return response()->json( $response);
        }

        //
    }
}
