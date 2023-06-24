<?php

namespace App\Http\Controllers;

use App\Models\CarFix;
use App\Models\CarTask;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CarFixsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $carFixs = CarFix::select("*")
                ->with(['car:id,number'])
                ->with(['driver:id,name'])
                ->with(['car_fix_type:id,name'])
                ->with(['comitee:id,from_date'])
                ->orderBy('created_at', 'desc')
                ->get();
            $response['data']=$carFixs;
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
        $carFix=CarFix::where('date',$request['date'])->
        where('driver_id',$request['driver_id'])->
        where('car_id',$request['car_id'])->first();

        if($carFix){
            $response['status']=0;
            $response['message']='لا يمكنك تسجيل اصلاح لنفس السيارة والسائق بنفس التاريخ';
            $response['code']=409;
        }
        else{
            try {
                $new_carFix = new  CarFix();
                //Set Car Details
                $new_carFix->date = $request->date;
                $new_carFix->description = $request->description;
                $new_carFix->driver_id = $request->driver_id;
                $new_carFix->car_id = $request->car_id;
                $new_carFix->car_fix_type_id = $request->car_fix_type_id;
                $new_carFix->comitee_id = $request->comitee_id;
                $new_carFix->fix_place = $request->fix_place;
                $new_carFix->rubish_parts = $request->rubish_parts;
                $new_carFix->comitee_opinion = $request->comitee_opinion;
                $new_carFix->fix_details = $request->fix_details;
                $new_carFix->fix_price = $request->fix_price;


                $new_carFix->save();
                $response['data']=$new_carFix;
                $response['status']=1;
                $response['message']='تم تسجيل الاصلاح بنجاح';
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
        $carFix = CarFix::with(['car:id,number'])
            ->with(['driver:id,name'])
            ->with(['car_fix_type:id,name'])
            ->with(['comitee:id,from_date'])
            ->find($id);
        if ($carFix) {
            $response['data']=$carFix;
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

        $new_carFix = CarFix::find($id);
        if(is_null($new_carFix)){
            $response['status'] = 1;
            $response['message'] = 'الاصلاح غير موجود';
            $response['code'] = 409;
        }
        else{
            try {

                //Set Car Details
                $new_carFix->date = $request->date;
                $new_carFix->description = $request->description;
                $new_carFix->driver_id = $request->driver_id;
                $new_carFix->car_id = $request->car_id;
                $new_carFix->car_fix_type_id = $request->car_fix_type_id;
                $new_carFix->comitee_id = $request->comitee_id;
                $new_carFix->fix_place = $request->fix_place;
                $new_carFix->rubish_parts = $request->rubish_parts;
                $new_carFix->comitee_opinion = $request->comitee_opinion;
                $new_carFix->fix_details = $request->fix_details;
                $new_carFix->fix_price = $request->fix_price;



                $new_carFix->save();
                $response['data']=$new_carFix;
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
            $carFix = CarFix::findOrFail($id);
            $success =$carFix->delete();
            if($success){
                $response['status'] = 1;
                $response['message'] = 'تم حذف الاصلاح بنجاح';
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
