<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\MedicineLot;
use App\Models\MedicineStorage;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MedicineLotsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $res = MedicineLot::
                with(['medicine_source'])
                ->with(['pharmacy_company'])
                ->with(['medicine'])
                ->with(['medicine_commercial_form'])
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
        try{

            $record=MedicineLot::
                where('code,',$request['code'])
                ->first();
            if($record){
                $response['status']=0;
                $response['message']='Already Exist';
                $response['code']=409;
            }
            else{
                $record =MedicineLot::create($request->all());
                $response['status']=1;
                $response['message']='Created Successfully';
                $response['code']=200;

            }
            return response()->json( $response);
        } catch (QueryException $e) {
            $response['data'] = null;
            $response['code'] = 500;
            $response['message'] = 'Error '.$e;

            return response()->json($response);

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
        try {
            $res = MedicineLot::find($id);
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
            $record = MedicineLot::find($id);
            if(is_null($record)){
                $response['status'] = 1;
                $response['message'] = 'Not Exist';
                $response['code'] = 409;
            }
            else{
                $record->update($request->all());
                $response['status'] = 1;
                $response['message'] = 'Updated Successfully';
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
            $record = MedicineLot::findOrFail($id);
            $success =$record->delete();
            if($success){
                $response['status'] = 1;
                $response['message'] = 'Deleted Sucessfully';
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
    }
}
