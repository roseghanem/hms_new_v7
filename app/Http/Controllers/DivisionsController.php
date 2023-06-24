<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Division;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DivisionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $res = Division::with(['department:id,name'])->get();


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
        $division=Division::where('name',$request['name'])->first();
        if($division){
            $response['status']=0;
            $response['message']='الشعبة موجودة مسبقاً';
            $response['code']=409;
        }
        else{
            $division =Division::create($request->all());
            $response['status']=1;
            $response['message']='تم إنشاء الشعبة بنجاح';
            $response['code']=200;

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
        $res = Division::with(['department:id,name'])->find($id);
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
            $division = Division::find($id);
            if(is_null($division)){
                $response['status'] = 1;
                $response['message'] = ' Not Exist';
                $response['code'] = 409;
            }
            else{
                $division->update($request->all());
                $response['status'] = 1;
                $response['message'] = ' Updated Successfully';
                $response['code'] = 200;
            }
            return response()->json($response);

        }catch (QueryException $e){
            $response['status'] = 0;
            $response['data']=null;
            $response['code']=500;
            $response['message']='Error please ask admin';

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
            $division = Division::findOrFail($id);
            $success =$division->delete();
            if($success){
                $response['status'] = 1;
                $response['message'] = 'Deleted Successfully';
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
    }
        public function select(Request $request)
        {
          $page        = $request->get('page');
          $offset      = ($page - 1) * 10;
          $data        = Division::select('id', 'name',);

          if($request->term != null){
            $data = $data->where(function($query) use($request){
              $query =	$query->whereRaw( DB::raw( "LOWER(name) LIKE '%".$request->term."%'") )  ;
            });
          }

          $totalRows =  $data->count();
          $lastRow   =  $offset + 10;
          $morePages =  $lastRow < $totalRows;
          $data      =  $data->orderBy('id')->skip($offset)->take(10)->get();

          $results = [
            "results"    => $data->map(function($item){
              return [
                "id"   =>  $item['id'] ,
                "text" =>  ($item['id'] ." ".$item['name' ]),
              ];
            }),
            "pagination" => ["more" => $morePages ]
          ];

          return response()->json($results);
        }
        //
    }

