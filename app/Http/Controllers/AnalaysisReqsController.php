<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\AnalaysisReq;
use App\Models\AnalysisCategory;
use App\Models\Visit;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AnalaysisReqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  view('dashboard.analaysis_reqs.index');
        //
    }

    public function getData(Request $request)
    {
        $columns = ['analysis_reqs.id as id',
        'analysis_categories.name as analysis_category_name',
        'analysis_reqs.date as date',
        'analysis_reqs.notes as notes',
        'visits.id as visit_id',

        ];
    if ($request->ajax()) {
        $query  = AnalaysisReq::join('analysis_categories','analysis_reqs.analaysis_category_id','=','analysis_categories.id')
        ->join('visits','analysis_reqs.visit_id', '=','visits.id')

        ->select($columns);
        }


        return DataTables::of($query)

            ->make(true);
    }
  /*  protected function doFiltering(Request $request = null)
    {
        if ($this->search_query != "") {
            $whereCluase = "( ";
            foreach ($this->getFilteredColumns() as $column) {
                $whereCluase .=  $column . " LIKE '%" . $this->search_query . "%' OR ";
            }
            //delete last OR in whereCluause
            $whereCluase = substr($whereCluase, 0, strlen($whereCluase) - 3) . " )";
            $query = $this->query->whereRaw(DB::raw($whereCluase));

            $this->recordsFiltered = $this->query->count('*');
            return $this;
        }
        return $this;
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //  $analaysis_req_ids = AnalaysisReq::select(['id'])->get();


        return view('dashboard.analaysis_reqs.add');
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
        $analaysisReq=AnalaysisReq::create([
            'visit_id'              =>  $request->visit_id,
            'analaysis_category_id'=>  $request->analaysis_category_id,
            'notes'                 =>  $request->notes,
            'date'                 =>  $request->date,


        ]);
        return  redirect('analaysis_reqs');
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
        $analaysisReq = AnalaysisReq::find($id);
        if ( $analaysisReq) {
            $response['data']=$analaysisReq;
            $response['status'] = 1;
            $response['message'] = 'Success';
            $response['code'] = 200;
            // return response()->json($response);

            return  view('analaysisReq.show', compact('apps'));
        }
        else{
            $response['data']=null;
            $response['code']=404;
            $response['message']='Not Found';
            // return response()->json( $response);
            return  view('analaysisReq.show', compact('apps'));
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
        $analaysisReq = AnalaysisReq::find($id);
        return view('dashboard.analaysis_reqs.edit',compact('app'));

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
        $analaysisReq = AnalaysisReq::find($id);
        $analaysisReq->update([
            'visit_id'              =>  $request->visit_id,
            'analaysis_category_id' =>  $request->analaysis_category_id,
            'notes'                 =>  $request->notes,
            'date'                  =>  $request->date,


        ]);
        return  redirect('/analaysis_reqs');
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
            $analaysisnReq = AnalaysisReq::findOrFail($id);
            $success =$analaysisnReq->delete();
            if($success){
                $response['status'] = 1;
                $response['message'] = ' AnalaysisReq Deleted Successfully';
                $response['code'] = 200;
                //return response()->json($response);
                return  redirect('/analaysis_reqs');
            }
            else{
                $response['status'] = 0;
                $response['message'] = 'Error';
                $response['code'] = 500;
               // return response()->json($response);
               return  redirect('/analaysis_reqs');
            }


        }catch (QueryException $e){
            $response['data']=null;
            $response['code']=500;
            $response['message']='Error please ask admin';
           // return response()->json( $response);
           return  redirect('/analaysis_reqs');
        }

    }
    public function select(Request $request)
    {
      $page        = $request->get('page');
      $offset      = ($page - 1) * 10;
      $data        = AnalaysisReq::select('id');

      if($request->term != null){
        $data = $data->where(function($query) use($request){
          $query =	$query->whereRaw( DB::raw( "LOWER(id) LIKE '%".$request->term."%'") )  ;
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
            "text" =>  $item['id']
          ];
        }),
        "pagination" => ["more" => $morePages ]
      ];

      return response()->json($results);
}
}
