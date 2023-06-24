<?php

namespace App\Http\Controllers;
use App\Models\DrugForms;
use App\Models\PrescuiptionReq;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
class PrescuiptionReqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // try {
        //     $visit = Visit::select("*")
        //         ->orderBy('created_at', 'desc')
        //         ->get();
        //     $response['data'] = $visit;
        //     $response['status'] = 1;
        //     $response['message'] = 'Success';
        //     $response['code'] = 200;
        //     return  view('visit.destroy', compact('apps'));

        //     //  return response()->json($response);

        // } catch (QueryException $e) {
        //     $response['data'] = null;
        //     $response['code'] = 500;
        //     $response['message'] = 'Error';
        //     return  view('visit.destroy', compact('apps'));

        //    // return response()->json($response);
        // }
        return view('dashboard.prescuiption_reqs.index');
    }
    public function getData(Request $request)
    {

        $columns = ['prescuiption_reqs.id as id',
        'prescuiption_reqs.scientific_name as scientific_name',
        'prescuiption_reqs.gag as gag',
        'prescuiption_reqs.gag_unit as gag_unit',
        'prescuiption_reqs.quantity as quantity',
        'prescuiption_reqs.quantity_unit as quantity_unit',
        'prescuiption_reqs.Treatment_Peroid as Treatment_Peroid',
        'prescuiption_reqs.method_of_use as method_of_use',
        'prescuiption_reqs.req_date as date',
        'prescuiption_reqs.visit_id as visit_id',
        'drug_forms.name as drug_form_name',
        ];
        if ($request->ajax()) {
            $query  = PrescuiptionReq::join('drug_forms', 'prescuiption_reqs.drug_form_id', '=', 'drug_forms.id')
            ->join('visits', 'prescuiption_reqs.visit_id', '=', 'visits.id')
            ->select($columns);
            }
            return DataTables::of($query)

           ->make(true);

    }
    public function edit($id)
    {
        $prescuiption_req = PrescuiptionReq::find($id);
        return  view('dashboard.prescuiption_reqs.edit',compact('prescuiption_req'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //
    public function create()
    {
        return  view('dashboard.prescuiption_reqs.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $prescuiption_req =PrescuiptionReq::create([

            'drug_form_id'       =>  $request->drug_form_id,
            'visit_id'           =>  $request->visit_id,
            'req_date'           =>  $request->req_date,
            'gag'                =>  $request->gag ,
            'gag_unit'           =>  $request->gag_unit ,
            'quantity'           =>  $request->quantity,
            'quantity_unit'      =>  $request->quantity_unit,
            'Treatment_Peroid'   =>  $request->Treatment_Peroid,
            'scientific_name'    =>  $request->scientific_name,
            'method_of_use'      =>  $request->method_of_use,


        ]);

        return  redirect('/prescuiption_reqs');
}
/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

public function show($id)
    {
        $prescuiption_req = PrescuiptionReq::find($id);
        if ( $prescuiption_req) {
            $response['data']=$prescuiption_req;
            $response['status'] = 1;
            $response['message'] = 'Success';
            $response['code'] = 200;
            // return response()->json($response);
            return  view('prescuiption_req.show', compact('apps'));
        }
        else{
            $response['data']=null;
            $response['code']=404;
            $response['message']='Not Found';
            // return response()->json( $response);
            return  view('prescuiption_req.show', compact('apps'));
        }
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

               $prescuiption_req = PrescuiptionReq::find($id);
               $prescuiption_req->update([
                'drug_form_id'       =>  $request->drug_form_id,
                'visit_id'           =>  $request->visit_id,
                'req_date'           =>  $request->req_date?$request->req_date: $prescuiption_req->req_date,
                'gag'                =>  $request->gag ,
                'gag_unit'           =>  $request->gag_unit ,
                'quantity'           =>  $request->quantity,
                'quantity_unit'      =>  $request->quantity_unit,
                'Treatment_Peroid'   =>  $request->Treatment_Peroid,
                'scientific_name'    =>  $request->scientific_name,
                'method_of_use'      =>  $request->method_of_use,


               ]);

               return  redirect('/prescuiption_reqs');

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
            $prescuiption_req = PrescuiptionReq::findOrFail($id);
            $success = $prescuiption_req->delete();
            if($success){
                $response['status'] = 1;
                $response['message'] = 'PrescuiptionReq Deleted Successfully';
                $response['code'] = 200;
                //return response()->json($response);
                return  redirect('/prescuiption_reqs');
            }
            else{
                $response['status'] = 0;
                $response['message'] = 'Error';
                $response['code'] = 500;
               // return response()->json($response);
               return  redirect('/prescuiption_reqs');
            }


        }catch (QueryException $e){
            $response['data']=null;
            $response['code']=500;
            $response['message']='Error please ask admin';
           // return response()->json( $response);
           return  redirect('/prescuiption_reqs');
        }

        //


}

}
