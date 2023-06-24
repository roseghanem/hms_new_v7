<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\DrugForms;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
class DrugFormsController extends Controller
{
    //
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('dashboard.drug_forms.index');


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
            $data = DrugForms::get();
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
       return view('dashboard.drug_forms.add');
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
        $drugForm = DrugForms::where('name', $request->name)->first();
        if ($drugForm) {
            $response['data'] = null;
            $response['status'] = 0;
            $response['message'] = 'DrugForm Already Exist';
            $response['code'] = 409;
        } else {
            try {
                $new_drugForm = new  DrugForms();
                //Set BloodGroup Details
                $new_drugForm->name = $request->name;

                $new_drugForm->save();
                $response['data'] = $new_drugForm;
                $response['status'] = 1;
                $response['message'] = 'DrugForm Created Successfully';
                $response['code'] = 200;
            } catch (\Exception $ex) {

                $response['data'] = null;
                $response['status'] = 1;
                $response['message'] = 'Error Please Ask Admin';
                $response['code'] = 500;
            }

        }
        return redirect('drug_forms');
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
            $drugForm = DrugForms::find($id);
            if ($drugForm) {

                $response['data'] = $drugForm;
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
        $drugForm = DrugForms::find($id);
        return view('dashboard.drug_forms.edit',compact('drugForm'));
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
        $drugForm = DrugForms::find($id);
        if ($drugForm) {
            try {
                //Set Details
                $drugForm->name = $request->name;
                $drugForm->save();
                $response['data'] = $drugForm;
                $response['status'] = 1;
                $response['message'] = 'DrugForm Updated Successfully';
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
            $response['message'] = 'DrugForm Not Exist';
            $response['code'] = 409;
        }
       // return response()->json($response);//
       return redirect('/drug_forms');
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
            $drugForm = DrugForms::findOrFail($id);
            $success = $drugForm->delete();
            if ($success) {
                $response['status'] = 1;
                $response['message'] = 'DrugForm Deleted Successfully';
                $response['code'] = 200;
                return redirect('/drug_forms');
            } else {
                $response['status'] = 0;
                $response['message'] = 'Error';
                $response['code'] = 500;
                return redirect('/drug_forms');
            }


        } catch (QueryException $e) {
            $response['data'] = null;
            $response['code'] = 500;
            $response['message'] = 'Error please ask admin';
            return redirect('/drug_forms');
        }
    }


    public function select(Request $request)
    {
      $page  = $request->get('page');
      $offset= ($page - 1) * 10;
      $data  = DrugForms::select('id', 'name');

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
