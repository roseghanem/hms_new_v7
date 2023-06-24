<?php
namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\AddmissiomNote;
use App\Models\Division;
use App\Models\Visit;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
class AddmissionNotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  view('dashboard.addmission_notes.index');
        //
    }

   public function getData(Request $request)
    {
        $columns = ['addmissiom_notes.id as id',
        'addmissiom_notes.date as date',
       
        'addmissiom_notes.notes as notes',
        'divisions.name as divison_name',
        'visits.id as visit_id',

        ];
    if ($request->ajax()) {
        $query  = AddmissiomNote::join('divisions','addmissiom_notes.division_id','=','divisions.id')
        ->join('visits','addmissiom_notes.visit_id', '=','visits.id')

        ->select($columns);
        }


        return DataTables::of($query)

            ->make(true);

/*
        if ($request->ajax()) {
            $query  = AddmissiomNote::join('divisions', 'division.id', '=', 'addmission_notes.division.id')
            ->join('visits', 'visit.id', '=', 'addmission_notes.visit_id')
            ->select(['visit.id as visit_id',
            'division.name as division_name']);
            if ($request->search_query != "") {
           //     dd("srfegv");
                $whereCluase = "( ";
                foreach ($columns as $column) {
                    $whereCluase .=  $column . " LIKE '%" . $this->search_query . "%' OR ";
                }
                //delete last OR in whereCluause
                $whereCluase = substr($whereCluase, 0, strlen($whereCluase) - 3) . " )";
                $query = $query->whereRaw(DB::raw($whereCluase));

                $recordsFiltered = $query->count('*');
                return $this;
            }

            return DataTables::of($query)

                ->make(true);
        }*/
    }
    protected function doFiltering(Request $request = null)
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
    }







    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $division_ids = Division::select(['id'])->get();


        return view('dashboard.addmission_notes.add',compact('division_ids'));
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
       
        $addmissionNote=AddmissiomNote::create([
            'visit_id'              =>  $request->visit_id,
            'division_id'            =>  $request->division_id,
            'notes'                 =>  $request->notes,
            'date'                 =>  $request->date,


        ]);
        return  redirect('/addmission_notes');
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
        $addmissionNote = AddmissiomNote::find($id);
        if ( $addmissionNote) {
            $response['data']=$addmissionNote;
            $response['status'] = 1;
            $response['message'] = 'Success';
            $response['code'] = 200;
            // return response()->json($response);
            return  view('addmissionNote.show', compact('apps'));
        }
        else{
            $response['data']=null;
            $response['code']=404;
            $response['message']='Not Found';
            // return response()->json( $response);
            return  view('addmissionNote.show', compact('apps'));
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
        $addmissionNote = AddmissiomNote::find($id);
        return view('dashboard.addmission_notes.edit',compact('addmissionNote'));
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
        $addmissionNote = AddmissiomNote::find($id);
        $addmissionNote->update([
            'visit_id'              =>  $request->visit_id,
            'divison_id'            =>  $request->divison_id,
            'notes'                 =>  $request->notes,
            'date'                  =>  $request->date,


        ]);
        return  redirect('/addmission_notes');
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
            $addmissionNote = AddmissiomNote::findOrFail($id);
            $success =$addmissionNote->delete();
            if($success){
                $response['status'] = 1;
                $response['message'] = 'AddmissiomNote Deleted Successfully';
                $response['code'] = 200;
                //return response()->json($response);
                return  redirect('/addmission_notes');
            }
            else{
                $response['status'] = 0;
                $response['message'] = 'Error';
                $response['code'] = 500;
               // return response()->json($response);
               return  redirect('/addmission_notes');
            }


        }catch (QueryException $e){
            $response['data']=null;
            $response['code']=500;
            $response['message']='Error please ask admin';
           // return response()->json( $response);
           return  redirect('/addmission_notes');
        }
    }
    ////////////////////////////////
    public function select(Request $request)
    {
      $page        = $request->get('page');
      $offset      = ($page - 1) * 10;
      $data        = AddmissiomNote::select('id');

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
