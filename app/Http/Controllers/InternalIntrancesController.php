<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\InternalIntrance;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use function MongoDB\BSON\toRelaxedExtendedJSON;

class InternalIntrancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $res = InternalIntrance::
            with(['doctor:id,first_name,father_name,last_name,mother_name'])->
            with(['division:id,name'])->
            with(['patient:id,first_name,father_name,last_name,mother_name'])->
            get();


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
            'division_id' => 'required|',
            'patient_id'  => 'required',
            'in_date'  => 'required'
        ));

        try {
            $internalIntrance=InternalIntrance::
            where('division_id',$request['division_id'])
                ->where('patient_id',$request['patient_id'])
                ->where('in_date',$request['in_date'])
                ->first();

            $internalIntrance2=InternalIntrance::
            where('division_id',$request['division_id'])
                ->where('patient_id',$request['patient_id'])
                ->where('out_date',null)
                ->first();

            if($internalIntrance){
                $response['status']=0;
                $response['message']='لا يمكنك تسجيل قبول لنفس المريض ولنفس الشعبة في نفس التاريخ';
                $response['code']=409;
            }
            elseif ($internalIntrance2){
                $response['status']=0;
                $response['message']='لا يمكنك تسجيل قبول لنفس المريض وهو لم يتم تخريجه بعد';
                $response['code']=409;
            }
            else{
                $rec =InternalIntrance::create($request->all());
                $division = Division::find($request['division_id']);
                $division->taken_beds=$division->taken_beds+1;
                $division->save();
                $response['status']=1;
                $response['message']='Created Successfully';
                $response['code']=200;
            }
            return response()->json( $response);
        }
        catch (QueryException $e){
            $response['data']=null;
            $response['code']=500;
            $response['message']='Error';

            return response()->json( $response);
        }

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
        $res = InternalIntrance::find($id);
        if ($res) {
            $response['data']=$res;
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
        try {
            $internalIntrance = InternalIntrance::find($id);
            if(is_null($internalIntrance)){
                $response['status'] = 1;
                $response['message'] = 'Not Exist';
                $response['code'] = 409;
            }
            else{
                if($request->out_date!=null){

                    $division = Division::find($internalIntrance->division_id);
                    $division->taken_beds=$division->taken_beds-1;
                    $division->save();
                }
                $internalIntrance->update($request->all());
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
            $internalIntrance = InternalIntrance::findOrFail($id);

            $division = Division::find($internalIntrance->division_id);
            $division->taken_beds=$division->taken_beds-1;
            $division->save();
            $success =$internalIntrance->delete();
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
