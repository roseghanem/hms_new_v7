<?php

namespace App\Http\Controllers;

use App\Models\CarAccident;
use App\Models\CarDellivery;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CarDelliveriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //
    public function index()
    {
        try {
            $carDelliverys = CarDellivery::select("*")
                ->with(['car:id,number'])
                ->with(['driver:id,name'])
                ->with(['car_dellivery_type:id,name'])
                ->orderBy('created_at', 'desc')
                ->get();
            $response['data']=$carDelliverys;
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
            'from_date' => 'required|',
            'driver_id'  => 'required',
            'car_id'  => 'required'
        ));
        $carDellivery=CarDellivery::where('from_date',$request['from_date'])->
        where('driver_id',$request['driver_id'])->
        where('car_id',$request['car_id'])->first();

        if($carDellivery){
            $response['status']=0;
            $response['message']='لا يمكنك تسجيل محضر تسليم لنفس السيارة والسائق بنفس التاريخ';
            $response['code']=409;
        }
        else{
            try {
                $carDellivery = new  CarDellivery();




                //Set Car Details
                $carDellivery->from_date = $request->from_date;
                $carDellivery->to_date = $request->to_date;
                $carDellivery->driver_id = $request->driver_id;
                $carDellivery->car_id = $request->car_id;
                $carDellivery->description = $request->description;
                $carDellivery->accesories = $request->accesories;
                $carDellivery->sub_accesories = $request->sub_accesories;
                $carDellivery->out_state = $request->out_state;
                $carDellivery->in_state = $request->in_state;
                $carDellivery->engine_state = $request->engine_state;
                $carDellivery->tires_state = $request->tires_state;
                $carDellivery->note = $request->note;

                $carDellivery->electricity_state = $request->electricity_state;
                $carDellivery->battery_state = $request->battery_state;
                $carDellivery->dozan_state = $request->dozan_state;
                $carDellivery->light_state = $request->light_state;
                $carDellivery->tire_size = $request->tire_size;
                $carDellivery->delliver_person = $request->delliver_person;
                $carDellivery->tire_date = $request->tire_date;
                $carDellivery->kilometrage = $request->kilometrage;

                $carDellivery->car_dellivery_type_id = $request->car_dellivery_type_id;





                $carDellivery->save();
                $response['data']=$carDellivery;
                $response['status']=1;
                $response['message']='تم تسجيل محضر التسليم';
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
        $carDellivery = CarDellivery::
        with(['car:id,number'])
        ->with(['driver:id,name'])
        ->with(['car_dellivery_type:id,name'])
        ->find($id);
        if ($carDellivery) {
            $response['data']=$carDellivery;
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

//        $this->validate($request, array(
//            'from_date' => 'required|',
//            'driver_id'  => 'required',
//            'car_id'  => 'required'
//        ));

       $new_carDellivery = CarDellivery::find($id);
        if(is_null($new_carDellivery)){
            $response['status'] = 1;
            $response['message'] = 'المحضر غير موجود';
            $response['code'] = 409;
        }
        else{
            try {

                //Set Car Details
             /*   $new_carDellivery->from_date = $request->from_date;
                $new_carDellivery->to_date = $request->to_date;
                $new_carDellivery->driver_id = $request->driver_id;
                $new_carDellivery->car_id = $request->car_id;
                $new_carDellivery->description = $request->description;
                $new_carDellivery->accesories = $request->accesories;
                $new_carDellivery->sub_accesories = $request->sub_accesories;
                $new_carDellivery->out_state = $request->out_state;
                $new_carDellivery->in_state = $request->in_state;
                $new_carDellivery->engine_state = $request->engine_state;
                $new_carDellivery->tires_state = $request->tires_state;
                $new_carDellivery->note = $request->note;
                $new_carDellivery->electricity_state = $request->electricity_state;
                $new_carDellivery->battery_state = $request->battery_state;
                $new_carDellivery->dozan_state = $request->dozan_state;
                $new_carDellivery->light_state = $request->light_state;
                $new_carDellivery->tire_size = $request->tire_size;
                $new_carDellivery->delliver_person = $request->delliver_person;
                $new_carDellivery->tire_date = $request->tire_date;
                $new_carDellivery->kilometrage = $request->kilometrage;
                $new_carDellivery->car_dellivery_type_id = $request->car_dellivery_type_id;
                */
//                $new_carDellivery->save();
                $new_carDellivery->update($request->all());
                $response['data']=$new_carDellivery;
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
            $carDellivery = CarDellivery::findOrFail($id);
            $success =$carDellivery->delete();
            if($success){
                $response['status'] = 1;
                $response['message'] = 'تم حذف المحضر بنجاح';
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
