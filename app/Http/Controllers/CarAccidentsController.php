<?php

namespace App\Http\Controllers;

use App\Models\CarAccident;
use App\Models\CarFix;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CarAccidentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $carAccidents = CarAccident::select("*")
                ->with(['car:id,number'])
                ->with(['driver:id,name'])
                ->orderBy('created_at', 'desc')
                ->get();
            $response['data']=$carAccidents;
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
        'date' => 'required|',
        'description'  => 'required',
        'driver_id'  => 'required',
        'car_id'  => 'required'
    ));
        $carAccident=CarAccident::where('date',$request['date'])->
        where('driver_id',$request['driver_id'])->
        where('car_id',$request['car_id'])->first();

        if($carAccident){
            $response['status']=0;
            $response['message']='لا يمكنك تسجيل اصلاح لنفس السيارة والسائق بنفس التاريخ';
            $response['code']=409;
        }
        else{
            try {
                $carAccident = new  CarAccident();
                //Set Car Details
                $carAccident->date = $request->date;
                $carAccident->description = $request->description;
                $carAccident->driver_id = $request->driver_id;
                $carAccident->car_id = $request->car_id;
                $carAccident->police_no = $request->police_no;
                $carAccident->police_date = $request->police_date;
                $carAccident->save();
                $response['data']=$carAccident;
                $response['status']=1;
                $response['message']='تم تسجيل الحادث بنجاح';
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
        $carAccident = CarAccident::with(['car:id,number'])
            ->with(['driver:id,name'])->find($id);
        if ($carAccident) {
            $response['data']=$carAccident;
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
            'date' => 'required|',
            'description'  => 'required',
            'driver_id'  => 'required',
            'car_id'  => 'required'
        ));

        $new_carAccident = CarAccident::find($id);
        if(is_null($new_carAccident)){
            $response['status'] = 1;
            $response['message'] = 'الحادث غير موجود';
            $response['code'] = 409;
        }
        else{
            try {

                //Set Car Details
                $new_carAccident->date = $request->date;
                $new_carAccident->description = $request->description;
                $new_carAccident->driver_id = $request->driver_id;
                $new_carAccident->car_id = $request->car_id;
                $new_carAccident->police_no = $request->police_no;
                $new_carAccident->police_date = $request->police_date;
                $new_carAccident->save();
                $response['data']=$new_carAccident;
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
            $carAccident = CarAccident::findOrFail($id);
            $success =$carAccident->delete();
            if($success){
                $response['status'] = 1;
                $response['message'] = 'تم حذف الحادث بنجاح';
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
