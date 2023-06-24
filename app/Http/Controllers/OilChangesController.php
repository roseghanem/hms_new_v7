<?php

namespace App\Http\Controllers;

use App\Models\CarDellivery;
use App\Models\OilChange;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class OilChangesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $oilChange = OilChange::select("*")
                ->with(['car:id,number'])
                ->with(['driver:id,name'])
                ->orderBy('created_at', 'desc')
                ->get();
            $response['data']=$oilChange;
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
            'change_date' => 'required|',
            'old_kilometrage' => 'required|',
            'new_kilometrage' => 'required|',
            'oil_type' => 'required|',
            'quantity' => 'required|',
            'filter' => 'required|',
            'driver_id'  => 'required',
            'car_id'  => 'required'
        ));
        $oilChange=OilChange::where('change_date',$request['change_date'])->
        where('car_id',$request['car_id'])->first();

        if($oilChange){
            $response['status']=0;
            $response['message']='لا يمكنك تسجيل غيار زيت لنفس السيارة بنفس التاريخ';
            $response['code']=409;
        }
        else{
            try {
                $oilChange = new  OilChange();




                //Set Car Details

                $oilChange->change_date = $request->change_date;
                $oilChange->old_kilometrage = $request->old_kilometrage;
                $oilChange->new_kilometrage = $request->new_kilometrage;
                $oilChange->oil_type = $request->oil_type;
                $oilChange->quantity = $request->quantity;
                $oilChange->filter = $request->filter;
                $oilChange->driver_id = $request->driver_id;
                $oilChange->car_id = $request->car_id;
                $oilChange->save();





                $response['data']=$oilChange;
                $response['status']=1;
                $response['message']='تم تسجيل غيار الزيت';
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

        $oilChange = OilChange::
        with(['car:id,number'])
            ->with(['driver:id,name'])
            ->find($id);
        if ($oilChange) {
            $response['data']=$oilChange;
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


        $this->validate($request, array(
            'change_date' => 'required|',
            'old_kilometrage' => 'required|',
            'new_kilometrage' => 'required|',
            'oil_type' => 'required|',
            'quantity' => 'required|',
            'filter' => 'required|',
            'driver_id'  => 'required',
            'car_id'  => 'required'
        ));

        $oilChange = OilChange::find($id);
        if(is_null($oilChange)){
            $response['status'] = 1;
            $response['message'] = ' غير موجود';
            $response['code'] = 409;
        }
        else{
            try {

                //Set Car Details
                $oilChange->change_date = $request->change_date;
                $oilChange->old_kilometrage = $request->old_kilometrage;
                $oilChange->new_kilometrage = $request->new_kilometrage;
                $oilChange->oil_type = $request->oil_type;
                $oilChange->quantity = $request->quantity;
                $oilChange->filter = $request->filter;
                $oilChange->driver_id = $request->driver_id;
                $oilChange->car_id = $request->car_id;
                $oilChange->save();
                $response['data']=$oilChange;
                $response['status']=1;
                $response['message']='تم التعديل بنجاح';
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $oilChange = OilChange::findOrFail($id);
            $success =$oilChange->delete();
            if($success){
                $response['status'] = 1;
                $response['message'] = 'تم الحذف  بنجاح';
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
