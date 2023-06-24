<?php

namespace App\Http\Controllers;

use App\Models\CarTask;
use App\Models\Clinic;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CarTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $carTasks = CarTask::select("*")
                ->with(['car_task_type:id,name'])
                ->with(['car:id,number'])
                ->with(['driver:id,name'])
                ->orderBy('created_at', 'desc')
                ->get();
            $response['data']=$carTasks;
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
            'line'  => 'required',
            'length'  => 'required',
            'fuel'  => 'required',
            'driver_id'  => 'required',
            'car_id'  => 'required',
            'car_task_type_id'  => 'required',
        ));
        $carTask=CarTask::where('to_date',$request['to_date'])->
            where('from_date',$request['from_date'])->
            where('driver_id',$request['driver_id'])->
            where('car_id',$request['car_id'])->
            where('car_task_type_id',$request['car_task_type_id'])->first();

        if($carTask){
            $response['status']=0;
            $response['message']='لا يمكنك تسجيل مهمة لنفس السيارة والسائق بنفس التاريخ';
            $response['code']=409;
        }
        else{
            try {
                $new_car_task = new  CarTask();
                //Set Car Details
                $new_car_task->from_date = $request->from_date;
                $new_car_task->to_date = $request->to_date;
                $new_car_task->line = $request->line;
                $new_car_task->fuel = $request->fuel;
                $new_car_task->length = $request->length;
                $new_car_task->driver_id = $request->driver_id;
                $new_car_task->car_id = $request->car_id;
                $new_car_task->car_task_type_id = $request->car_task_type_id;

                $new_car_task->kilo_start = $request->kilo_start;
                $new_car_task->kilo_end = $request->kilo_end;
                $new_car_task->responsible_person = $request->responsible_person;
                $new_car_task->note = $request->note;

                $new_car_task->save();
                $response['data']=$new_car_task;
                $response['status']=1;
                $response['message']='Car Task Created Successfully';
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
        $carTask = CarTask::with(['car_task_type:id,name'])
            ->with(['car:id,number'])
            ->with(['driver:id,name'])->find($id);
        if ($carTask) {
            $response['data']=$carTask;
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
            'line'  => 'required',
            'length'  => 'required',
            'fuel'  => 'required',
            'driver_id'  => 'required',
            'car_id'  => 'required',
            'car_task_type_id'  => 'required',
        ));

        $new_car_task = CarTask::find($id);
        if(is_null($new_car_task)){
            $response['status'] = 1;
            $response['message'] = 'المهمة غير موجودة';
            $response['code'] = 409;
        }
        else{
            try {

                //Set Car Details
                $new_car_task->from_date = $request->from_date;
                $new_car_task->to_date = $request->to_date;
                $new_car_task->line = $request->line;
                $new_car_task->fuel = $request->fuel;
                $new_car_task->length = $request->length;
                $new_car_task->driver_id = $request->driver_id;
                $new_car_task->car_id = $request->car_id;
                $new_car_task->car_task_type_id = $request->car_task_type_id;

                $new_car_task->kilo_start = $request->kilo_start;
                $new_car_task->kilo_end = $request->kilo_end;
                $new_car_task->responsible_person = $request->responsible_person;
                $new_car_task->note = $request->note;
                $new_car_task->save();
                $response['data']=$new_car_task;
                $response['status']=1;
                $response['message']='Car Task Updated Successfully';
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
            $carTask = CarTask::findOrFail($id);
            $success =$carTask->delete();
            if($success){
                $response['status'] = 1;
                $response['message'] = 'تم حذف المهمة بنجاح';
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
