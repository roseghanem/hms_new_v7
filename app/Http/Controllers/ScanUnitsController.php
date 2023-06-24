<?php

namespace App\Http\Controllers;

use App\Models\ScanUnit;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
class ScanUnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.scan_units.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = ScanUnit::select(['id','name','phone'])->get();
            return Datatables::of($data)

                ->make(true);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.scan_units.add');
    }
    public function edit($id)
    {
        $scan_unit = ScanUnit::find($id);
        return view('dashboard.scan_units.edit',compact('scan_unit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $scanUnit=ScanUnit::where('name',$request['name'])->first();
        if($scanUnit){
            $response['status']=0;
            $response['message']='ScanUnits Already Exist';
            $response['code']=409;
        }
        else{
            $scanUnit =ScanUnit::create($request->all());
            $response['status']=1;
            $response['message']='ScanUnits Created Successfully';
            $response['code']=200;

        }
        //return response()->json( $response);
        return  redirect('/scan_units');

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
        $scanUnit = ScanUnit::find($id);
        if ($scanUnit) {
            $response['data']=$scanUnit;
            $response['status'] = 1;
            $response['message'] = 'Success';
            $response['code'] = 200;
           // return response()->json($response);
            return  view('scanUnit.show', compact('apps'));
        }
        else{
            $response['data']=null;
            $response['code']=404;
            $response['message']='Not Found';
           // return response()->json( $response);
            return  view('scanUnit.show', compact('apps'));
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

    public function update( Request $request,$id)
    {
        try {
            $scanUnit = ScanUnit::find($id);
            if(is_null($scanUnit)){
                return  redirect('/scan_units');
            }
            else{
                $scanUnit->update($request->all());
                return  redirect('/scan_units');
            }
           // return response()->json($response);
           return  redirect('/scan_units');


        }catch (QueryException $e){
            return  redirect('/scan_units');
        }



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
            $scanUnit =ScanUnit::findOrFail($id);
            $success =$scanUnit->delete();
            if($success){

                //return response()->json($response);
                return  redirect('/scan_units');
            }
            else{
                return  redirect('/scan_units');
            }




        }catch (QueryException $e){
            return  redirect('/scan_units');
        }

        //
    }
    public function select(Request $request)
    {
      $page        = $request->get('page');
      $offset      = ($page - 1) * 10;
      $data        = ScanUnit::select('id', 'name');

      if($request->term != null){
        $data = $data->where(function($query) use($request){
          $query =	$query->whereRaw( DB::raw( "LOWER(name) LIKE '%".$request->term."%'") )  ;
        });
      }



      $totalRows =  $data->count();
      $lastRow   =  $offset + 10;
      $morePages =  $lastRow < $totalRows;
      $data      =  $data->orderBy('name')->skip($offset)->take(10)->get();

      $results = [
        "results"    => $data->map(function($item){
          return [
            "id"   =>  $item['id'] ,
            "text" =>  $item['name']
          ];
        }),
        "pagination" => ["more" => $morePages ]
      ];

      return response()->json($results);
    }
}
