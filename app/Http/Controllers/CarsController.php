<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Car;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $cars = Car::select("*")
                ->orderBy('created_at', 'desc')
                ->get();
            $response['data']=$cars;
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
            'number' => 'required|min:6|max:6',
            'city'  => 'required',
            'color'  => 'required',
            'weight'  => 'required',
            'year_of_production'  => 'required',
        ));
        $car=Car::where('number',$request->number)->first();
        if($car){
            $response['data']=null;
            $response['status']=0;
            $response['message']='Car Already Exist';
            $response['code']=409;
        }
        else{
            try {
                $new_car = new  Car();
                //Set Car Details
                $new_car->type = $request->type;
                $new_car->name = $request->name;
                $new_car->number = $request->number;
                $new_car->engine_number = $request->engine_number;
                $new_car->city = $request->city;
                $new_car->color =$request->color;
                $new_car->note =$request->note;
                $new_car->weight =$request->weight;
                $new_car->year_of_production =$request->year_of_production;
                $new_car->year_of_registration =$request->year_of_registration;

                $new_car->cylender_num =$request->cylender_num;
                $new_car->cc_size =$request->cc_size;
                $new_car->fuel_size =$request->fuel_size;
                $new_car->car_code =$request->car_code;
                $new_car->chasse_number =$request->chasse_number;
                $new_car->fuel_type =$request->fuel_type;










                $new_car->car_type_id =$request->car_type_id;
                $new_car->save();
                $response['data']=$new_car;
                $response['status']=1;
                $response['message']='Car Created Successfully';
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
            $car =Car::find($id);
            if($car)
            {

                $response['data']=$car;
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
            'number' => 'required|min:6|max:6',
            'city'  => 'required',
            'color'  => 'required',
            'weight'  => 'required',
            'year_of_production'  => 'required',
        ));
        $car=Car::find($id);
        if($car){
            try {
                //Set Car Details
                $car->type = $request->type;
                $car->name = $request->name;
                $car->number = $request->number;
                $car->engine_number = $request->engine_number;
                $car->city = $request->city;
                $car->color =$request->color;
                $car->note =$request->note;
                $car->weight =$request->weight;
                $car->year_of_production =$request->year_of_production;
                $car->year_of_registration =$request->year_of_registration;
                $car->car_type_id =$request->car_type_id;

                $car->cylender_num =$request->cylender_num;
                $car->cc_size =$request->cc_size;
                $car->fuel_size =$request->fuel_size;
                $car->car_code =$request->car_code;
                $car->chasse_number =$request->chasse_number;
                $car->fuel_type =$request->fuel_type;

                $car->save();
                $response['data']=$car;
                $response['status']=1;
                $response['message']='Car Updated Successfully';
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
                $response['message']='Car Not Exist';
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
            $car = Car::findOrFail($id);
            $success =$car->delete();
            if($success){
                $response['status'] = 1;
                $response['message'] = 'Car Deleted Successfully';
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
