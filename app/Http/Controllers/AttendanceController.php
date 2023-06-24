<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Division;
use App\Models\Visit;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $attendance = Attendance::select("*")
                ->orderBy('created_at', 'desc')
                ->get();
            $response['data'] = $attendance;
            $response['status'] = 1;
            $response['message'] = 'Success';
            $response['code'] = 200;
          //  return response()->json($response);
            return  view('attendance.destroy', compact('apps'));


        } catch (QueryException $e) {
            $response['data'] = null;
            $response['code'] = 500;
            $response['message'] = 'Error';
            return  view('attendance.destroy', compact('apps'));

          //  return response()->json($response);
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
        $attendance=Attendance::where('name',$request['name'])->first();
        if($attendance){
            $response['status']=0;
            $response['message']='موجود مسبقاً';
            $response['code']=409;
        }
        else{
            $attendance =Attendance::create($request->all());
            $response['status']=1;
            $response['message']='تم إنشاء';
            $response['code']=200;

        }
      //  return response()->json( $response);
        return  view('attendance.store', compact('apps'));

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
            $attendance = Attendance::find($id);
            if ($attendance) {

                $response['data'] =  $attendance ;
                $response['status'] = 1;
                $response['message'] = 'Success';
                $response['code'] = 200;
                // return response()->json($response);
                return  view('attendance.show', compact('apps'));

            } else {

                $response['data'] = null;
                $response['status'] = 1;
                $response['message'] = 'Not Found';
                $response['code'] = 200;
                //return response()->json($response);
                return  view('attendance.show', compact('apps'));

            }

        } catch (QueryException $e) {
            $response['data'] = null;
            $response['code'] = 500;
            $response['message'] = 'Not Found';

            //return response()->json($response);
            return  view('attendance.show', compact('apps'));

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
            'date' => 'required',
        ));
        $attendance = Attendance::find($id);
        if ($attendance) {
            try {
                //Set Attendance Details
                $attendance->date = $request->date;
                $attendance->save();
                $response['data'] = $attendance;
                $response['status'] = 1;
                $response['message'] = 'Attendance Updated Successfully';
                $response['code'] = 200;
            } catch (\Exception $ex) {

                $response['data'] = null;
                $response['status'] = 1;
                $response['message'] = 'Error Please Ask Admin';
                $response['code'] = 500;
            }
        } else {

            $response['data'] = null;
            $response['status'] = 0;
            $response['message'] = 'Attendance Not Exist';
            $response['code'] = 409;
        }
        //return response()->json($response);
        return  view('$attendance.update', compact('apps'));

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
            $attendance = Attendance::findOrFail($id);
            $success = $attendance->delete();
            if ($success) {
                $response['status'] = 1;
                $response['message'] = 'Attendance Deleted Successfully';
                $response['code'] = 200;
                // return response()->json($response);
                return  view('attendance.destory', compact('apps'));

            } else {
                $response['status'] = 0;
                $response['message'] = 'Error';
                $response['code'] = 500;
                //  return response()->json($response);
                return  view('attendance.destory', compact('apps'));

            }


        } catch (QueryException $e) {
            $response['data'] = null;
            $response['code'] = 500;
            $response['message'] = 'Error please ask admin';
            //return response()->json($response);
            return  view('attendance.destory', compact('apps'));

        }
     //
    }
}
