<?php

namespace App\Http\Controllers;

use App\Models\CarAccident;
use App\Models\CarInsurance;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CarInsurancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $carInsurances = CarInsurance::select("*")
                ->with(['car:id,number'])
                ->orderBy('created_at', 'desc')
                ->get();
            $response['data']=$carInsurances;
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
            'to_date'  => 'required',
            'price'  => 'required',
            'car_id'  => 'required'
        ));
        $carInsurance=CarInsurance::where('from_date',$request['from_date'])->
        where('car_id',$request['car_id'])->first();

        if($carInsurance){
            $response['status']=0;
            $response['message']='لا يمكنك تسجيل ترسيم لنفس السيارة و بنفس التاريخ';
            $response['code']=409;
        }
        else{
            try {
                $carInsurance = new  CarInsurance();
                //Set Car Details
                $carInsurance->from_date = $request->from_date;
                $carInsurance->to_date = $request->to_date;
                $carInsurance->car_id = $request->car_id;
                $carInsurance->price = $request->price;
                $carInsurance->note = $request->note;
                $carInsurance->save();
                $response['data']=$carInsurance;
                $response['status']=1;
                $response['message']='تم تسجيل الترسيم بنجاح';
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
        $carInsurance = CarInsurance::with(['car:id,number'])->find($id);
        if ($carInsurance) {
            $response['data']=$carInsurance;
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
            'from_date' => 'required|',
            'to_date'  => 'required',
            'price'  => 'required',
            'car_id'  => 'required'
        ));
        $carInsurance=CarInsurance::find($id);
        if(is_null($carInsurance)){
            $response['status'] = 1;
            $response['message'] = 'الترسيم غير موجود';
            $response['code'] = 409;
        }
        else{
            try {

                //Set Car Details
                $carInsurance->from_date = $request->from_date;
                $carInsurance->to_date = $request->to_date;
                $carInsurance->car_id = $request->car_id;
                $carInsurance->price = $request->price;
                $carInsurance->note = $request->note;
                $carInsurance->save();
                $response['data']=$carInsurance;
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
        $carInsurance = CarInsurance::findOrFail($id);
        $success =$carInsurance->delete();
        if($success){
            $response['status'] = 1;
            $response['message'] = 'تم حذف الترسيم بنجاح';
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
