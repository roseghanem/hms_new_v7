<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\MedicineSource;
use App\Models\PharmacyCompany;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MedicinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $res = Medicine::get();
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

            $record=Medicine::where('scientific_name',$request['scientific_name'])->first();
            if($record){
                $response['status']=0;
                $response['message']='Already Exist';
                $response['code']=409;
            }
            else{
                $record =Medicine::create($request->all());
                $response['status']=1;
                $response['message']='Created Successfully';
                $response['code']=200;

            }
            return response()->json( $response);
        } catch (QueryException $e) {
            $response['data'] = null;
            $response['code'] = 500;
            $response['message'] = 'Error';

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
            $res = Medicine::find($id);
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
            $record = Medicine::find($id);
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
            $record = Medicine::findOrFail($id);
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


    public function searchByScientificName(Request $request)
    {
        try {
            $res = MedicineSource::where('scientific_name',$request->scientific_name)
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

    public function searchByArabicName(Request $request)
    {
        try {
            $res = MedicineSource::where('arabic_name',$request->scientific_name)
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
}
