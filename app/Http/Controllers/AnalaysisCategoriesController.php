<?php

namespace App\Http\Controllers;
use App\Models\AnalysisCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AnalaysisCategoriesController extends Controller
{
    //
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.analaysis_categories.index');
    }


    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data =AnalysisCategory::select(['id','name'])->get();
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
        return view('dashboard.analaysis_categories.add');
    }
    public function edit($id)
    {
        $analaysis_category = AnalysisCategory::find($id);
        return view('dashboard.analaysis_categories.edit',compact('app'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $analaysisCategory=AnalysisCategory::where('name',$request['name'])->first();
        if($analaysisCategory){
            $response['status']=0;
            $response['message']='Analaysis Category Already Exist';
            $response['code']=409;
        }
        else{
            $analaysisCategory =AnalysisCategory::create($request->all());
            $response['status']=1;
            $response['message']='Analaysis Category Created Successfully';
            $response['code']=200;

        }
        //return response()->json( $response);
        return  redirect('/analaysis_categories');

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
        $analaysisCategory = AnalysisCategory::find($id);
        if ($analaysisCategory) {
            $response['data']=$analaysisCategory;
            $response['status'] = 1;
            $response['message'] = 'Success';
            $response['code'] = 200;
           // return response()->json($response); this is for angular....
            return  view('analaysisCategory.show', compact('apps'));
        }
        else{
            $response['data']=null;
            $response['code']=404;
            $response['message']='Not Found';
           // return response()->json( $response);
            return  view('analaysisCategory.show', compact('apps'));
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
            $analaysisCategory = AnalysisCategory::find($id);
            if(is_null($analaysisCategory)){
                return  redirect('/analaysis_categories');
            }
            else{
                $analaysisCategory->update($request->all());
                return  redirect('/analaysis_categories');
            }
           // return response()->json($response);
           return  redirect('/analaysis_categories');


        }catch (QueryException $e){
            return  redirect('/analaysis_categories');
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
            $analaysisCategory =AnalysisCategory::findOrFail($id);
            $success =$analaysisCategory->delete();
            if($success){

                //return response()->json($response);
                return  redirect('/analaysis_categories');
            }
            else{
                return  redirect('/analaysis_categories');
            }



        }catch (QueryException $e){
            return  redirect('/analaysis_categories');
        }

        //
    }
    public function select(Request $request)
    {
      $page        = $request->get('page');
      $offset      = ($page - 1) * 10;
      $data        = AnalysisCategory::select('id', 'name');

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
