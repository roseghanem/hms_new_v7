<?php

namespace App\Http\Controllers;

use App\Models\BloodGroup;
use App\Models\Car;
use App\Models\Clinic;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Yajra\DataTables\Facades\DataTables;
class BloodGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('dashboard.blood_groups.index');


        /*try {
            $bloodGroup = BloodGroup::select("*")
                ->orderBy('created_at', 'desc')
                ->get();
            $response['data'] = $bloodGroup;
            $response['status'] = 1;
            $response['message'] = 'Success';
            $response['code'] = 200;
            //return response()->json($response);
            return  view('blood_groups.index', compact('apps'));

        } catch (QueryException $e) {
            $response['data'] = null;
            $response['code'] = 500;
            $response['message'] = 'Error';
            return  view('blood_groups.index', compact('apps'));

            //return response()->json($response);
        }//*/

    }
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = BloodGroup::get();
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
       return view('dashboard.blood_groups.add');
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
        $bloodGroup = BloodGroup::where('name', $request->name)->first();
        if ($bloodGroup) {
            $response['data'] = null;
            $response['status'] = 0;
            $response['message'] = 'BloodGroup Already Exist';
            $response['code'] = 409;
        } else {
            try {
                $new_bloodGroup = new  BloodGroup();
                //Set BloodGroup Details
                $new_bloodGroup->name = $request->name;

                $new_bloodGroup->save();
                $response['data'] = $new_bloodGroup;
                $response['status'] = 1;
                $response['message'] = 'BloodGroup Created Successfully';
                $response['code'] = 200;
            } catch (\Exception $ex) {

                $response['data'] = null;
                $response['status'] = 1;
                $response['message'] = 'Error Please Ask Admin';
                $response['code'] = 500;
            }

        }
        return redirect('blood_groups');
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
        $bloodGroup = BloodGroup::find($id);
        return view('dashboard.blood_groups.edit',compact('bloodGroup'));
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
        $bloodGroup = BloodGroup::find($id);
        if ($bloodGroup) {
            try {
                //Set BloodGroup Details
                $bloodGroup->name = $request->name;
                $bloodGroup->save();
                $response['data'] = $bloodGroup;
                $response['status'] = 1;
                $response['message'] = 'BloodGroup Updated Successfully';
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
            $response['message'] = 'BloodGroup Not Exist';
            $response['code'] = 409;
        }
       // return response()->json($response);//
       //return back();
       return redirect('/blood_groups');
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
            $bloodGroup = BloodGroup::findOrFail($id);
            $success = $bloodGroup->delete();
            if ($success) {
                $response['status'] = 1;
                $response['message'] = 'BloodGroup Deleted Successfully';
                $response['code'] = 200;
                return redirect('/blood_groups');
            } else {
                $response['status'] = 0;
                $response['message'] = 'Error';
                $response['code'] = 500;
                return redirect('/blood_groups');
            }


        } catch (QueryException $e) {
            $response['data'] = null;
            $response['code'] = 500;
            $response['message'] = 'Error please ask admin';
            return redirect('/blood_groups');
        }
    }


    public function select(Request $request)
    {
      $page        = $request->get('page');
      $offset      = ($page - 1) * 10;
      $data        = BloodGroup::select('id', 'name');

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
