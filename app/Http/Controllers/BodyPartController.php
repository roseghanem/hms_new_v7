<?php

namespace App\Http\Controllers;

use App\Models\BloodGroup;
use App\Models\BodyPart;
use App\Models\Car;
use App\Models\Clinic;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Yajra\DataTables\Facades\DataTables;
class BodyPartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.body_part.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = BodyPart::select(['id','name'])->get();
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
       return view('dashboard.body_part.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required',
        ));
   
                $body_part = new  BodyPart();
                //Set BloodGroup Details
                $body_part->name = $request->name;

                $body_part->save();
   

        return redirect('/body_parts');
      //  return response()->json($response);

        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $bloodGroup = BloodGroup::find($id);
            if ($bloodGroup) {

                $response['data'] = $bloodGroup;
                $response['status'] = 1;
                $response['message'] = 'Success';
                $response['code'] = 200;
                return response()->json($response);
            } else {

                $response['data'] = null;
                $response['status'] = 1;
                $response['message'] = 'Not Found';
                $response['code'] = 200;
                return response()->json($response);
            }

        } catch (QueryException $e) {
            $response['data'] = null;
            $response['code'] = 500;
            $response['message'] = 'Not Found';

            return response()->json($response);
        }
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $body_part = BodyPart::find($id);
        return view('dashboard.body_part.edit',compact('body_part'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required',
        ));
        $body_part = BodyPart::find($id);
        if ($body_part) {
           
                //Set BloodGroup Details
                $body_part->name = $request->name;
                $body_part->save();
      

        }
       // return response()->json($response);//
       return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $body_part = BodyPart::findOrFail($id);
            $success = $body_part->delete();
            if ($success) {
        
                return redirect('/body_part');
            } else {
           
                return redirect('/body_parts');
            }


        } catch (QueryException $e) {
         
            return redirect('/body_part');
        }
    }

   
    public function select(Request $request)
    {
      $page        = $request->get('page');
      $offset      = ($page - 1) * 10;
      $data        = BodyPart::select('id', 'name');

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
