<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\ScanRequest;
use App\Models\ScanUnit;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ScanRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  view('dashboard.scan_requests.index');

    }
    public function getData(Request $request)
    {

        $columns = ['scan_requests.id as id',

        'scan_requests.pregnant_woman as pregnant_woman',
        'scan_requests.patient_preparation as patient_preparation',
        'scan_requests.req_date as date',
        'scan_requests.visit_id as visit_id',
        'scan_units.name as scan_unit_name',
        'part_of_bodies.name as part_body_name',
        ];
        if ($request->ajax()) {
            $query  = ScanRequest::join('scan_units', 'scan_requests.scan_unit_id', '=', 'scan_units.id')
            ->join('part_of_bodies', 'scan_requests.part_of_body_id', '=', 'part_of_bodies.id')
            ->select($columns);
            }
            return DataTables::of($query)

           ->make(true);

    }

    public function edit($id)
    {
        $scan_request = ScanRequest::find($id);
        return  view('dashboard.scan_requests.edit',compact('app'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('dashboard.scan_requests.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $scanUnit =ScanRequest::create([
            'part_of_body_id'       =>  $request->part_of_body_id,
            'req_date'              =>  $request->req_date,
            'pregnant_woman'        =>  $request->pregnant_woman ? "1":"0",
            'patient_preparation'   =>  $request->patient_preparation ? "1":"0",
            'scan_unit_id'          =>  $request->scan_unit_id,
            'visit_id'              =>  $request->visit_id,
            'part_of_body_id'       =>  $request->part_of_body_id,
        ]);

        return  redirect('/scan_requests');
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
        $scanRequest = ScanRequest::find($id);
        if ( $scanRequest) {
            $response['data']=$scanRequest;
            $response['status'] = 1;
            $response['message'] = 'Success';
            $response['code'] = 200;
            // return response()->json($response);
            return  view('scanRequest.show', compact('apps'));
        }
        else{
            $response['data']=null;
            $response['code']=404;
            $response['message']='Not Found';
            // return response()->json( $response);
            return  view('scanRequest.show', compact('apps'));
        }
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

            $scanRequest = ScanRequest::find($id);
            $scanRequest->update([
                'part_of_body_id'       =>  $request->part_of_body_id,
                'req_date'              =>  $request->req_date?$request->req_date: $scanRequest->req_date,
                'pregnant_woman'        =>  $request->pregnant_woman ? "1":"0",
                'patient_preparation'   =>  $request->patient_preparation ? "1":"0",
                'scan_unit_id'          =>  $request->scan_unit_id,
                'visit_id'              =>  $request->visit_id,
                'part_of_body_id'       =>  $request->part_of_body_id,
            ]);

            return  redirect('/scan_requests');

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $scanRequest = ScanRequest::findOrFail($id);
            $success =$scanRequest->delete();
            if($success){
                $response['status'] = 1;
                $response['message'] = 'ScanRequest Deleted Successfully';
                $response['code'] = 200;
                //return response()->json($response);
                return  redirect('/scan_requests');
            }
            else{
                $response['status'] = 0;
                $response['message'] = 'Error';
                $response['code'] = 500;
               // return response()->json($response);
               return  redirect('/scan_requests');
            }


        }catch (QueryException $e){
            $response['data']=null;
            $response['code']=500;
            $response['message']='Error please ask admin';
           // return response()->json( $response);
           return  redirect('/scan_requests');
        }

        //
    }
        //
}
