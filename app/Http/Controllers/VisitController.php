<?php

namespace App\Http\Controllers;
use App\Models\Visit;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//         try {
//             $visit = Visit::select("*")
//                 ->orderBy('created_at', 'desc')
//                 ->get();
//             $response['data'] = $visit;
//             $response['status'] = 1;
//             $response['message'] = 'Success';
//             $response['code'] = 200;
//             return  view('visit.destroy', compact('visit'));
//
//             //  return response()->json($response);
//
//         } catch (QueryException $e) {
//             $response['data'] = null;
//             $response['code'] = 500;
//             $response['message'] = 'Error';
//             return  view('visit.destroy', compact('visit'));
//
//            // return response()->json($response);
//         }
        return view('dashboard.visits.index');

    }

    public function getData(Request $request)
    {

        $columns = ['visits.id as id',
        'doctors.first_name as doctor_name',
        'patients.first_name as patient_name',
        'visits.out_patient_id as out_patient_id',
        'diseases.ar_name as diseas_name',
        'clinics.name as clinic_name',
        'visits.patient_history as patient_history',
        'visits.medical_history as medical_history',
        'visits.surgical_history as surgical_history',
        'visits.family_history as family_history',
        'visits.allergic_history as allergic_history',
        'visits.habits as habits',
        'visits.date as date',

        ];
        if ($request->ajax()) {
            $query  = Visit::join('out_patients', 'out_patients.id', '=', 'visits.out_patient_id')
           ->join('patients', 'patients.id', '=', 'out_patients.patient_id')
            ->join('doctors', 'doctors.id', '=', 'visits.doctor_id')
            ->join('diseases', 'diseases.id', '=', 'visits.disease_id')
            ->join('clinics', 'clinics.id', '=', 'visits.clinic_id')
            ->select($columns);
                   return DataTables::of($query)

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
        return view('dashboard.visits.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, array(
        //     'date' => 'required',
        // ));
        // $visit = Visit::where('date', $request->date)->first();
        // if ($visit) {
        //     $response['data'] = null;
        //     $response['status'] = 0;
        //     $response['message'] = 'Visit Already Exist';
        //     $response['code'] = 409;
        // } else {
        //     try {
        //         $new_visit = new  Visit();
        //         //Set Visit Details
        //         $new_visit ->date = $request->date;

        //         $new_visit ->save();
        //         $response['data'] = $new_visit ;
        //         $response['status'] = 1;
        //         $response['message'] = 'visit Created Successfully';
        //         $response['code'] = 200;
        //     } catch (\Exception $ex) {

        //         $response['data'] = null;
        //         $response['status'] = 1;
        //         $response['message'] = 'Error Please Ask Admin';
        //         $response['code'] = 500;
        //     }

        // }
       // return response()->json($response);
        Visit::create($request->all());
        return redirect('visits');


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
            $visit = Visit::find($id);
            if ($visit) {

                $response['data'] =  $visit ;
                $response['status'] = 1;
                $response['message'] = 'Success';
                $response['code'] = 200;
               // return response()->json($response);
                return  view('visit.show', compact('apps'));

            } else {

                $response['data'] = null;
                $response['status'] = 1;
                $response['message'] = 'Not Found';
                $response['code'] = 200;
                //return response()->json($response);
                return  view('visit.show', compact('apps'));

            }

        } catch (QueryException $e) {
            $response['data'] = null;
            $response['code'] = 500;
            $response['message'] = 'Not Found';

           //return response()->json($response);
            return  view('visit.show', compact('apps'));

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
        $visit = Visit::find($id);
        return view('dashboard.visits.edit',compact('visit'));
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
            'date' => 'required',
        ));
        $visit = Visit::find($id);
        $visit->update($request->all());
        return redirect('visits');
        // if ($visit) {
        //     try {
        //         //Set Visit Details
        //         $visit->date = $request->date;
        //         $visit->save();
        //         $response['data'] = $visit;
        //         $response['status'] = 1;
        //         $response['message'] = 'Visit Updated Successfully';
        //         $response['code'] = 200;
        //     } catch (\Exception $ex) {

        //         $response['data'] = null;
        //         $response['status'] = 1;
        //         $response['message'] = 'Error Please Ask Admin';
        //         $response['code'] = 500;
        //     }
        // } else {

        //     $response['data'] = null;
        //     $response['status'] = 0;
        //     $response['message'] = 'Visit Not Exist';
        //     $response['code'] = 409;
        // }
        // //return response()->json($response);
        // return  view('visit.update', compact('apps'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visit = Visit::findOrFail($id);
        $visit->delete();
        return redirect('visits');
        // try {
        //     $visit = Visit::findOrFail($id);
        //     $success = $visit->delete();
        //     if ($success) {
        //         $response['status'] = 1;
        //         $response['message'] = 'Visit Deleted Successfully';
        //         $response['code'] = 200;
        //        // return response()->json($response);
        //         return  view('visit.destory', compact('apps'));

        //     } else {
        //         $response['status'] = 0;
        //         $response['message'] = 'Error';
        //         $response['code'] = 500;
        //       //  return response()->json($response);
        //         return  view('visit.destory', compact('apps'));

        //     }


        // } catch (QueryException $e) {
        //     $response['data'] = null;
        //     $response['code'] = 500;
        //     $response['message'] = 'Error please ask admin';
        //     //return response()->json($response);
        //     return  view('visit.destory', compact('apps'));

        // }
    }
    public function delete($id)
    {
        try {
            $visit = Visit::findOrFail($id);
            $success = $visit->delete();
            if ($success) {
                $response['status'] = 1;
                $response['message'] = 'switch_to_clinics Deleted Successfully';
                $response['code'] = 200;
                return redirect('/visits');
            } else {
                $response['status'] = 0;
                $response['message'] = 'Error';
                $response['code'] = 500;
                return redirect('/visits');
            }


        } catch (QueryException $e) {
            $response['data'] = null;
            $response['code'] = 500;
            $response['message'] = 'Error please ask admin';
            return redirect('/visits');
        }
    }
    public function select(Request $request)
    {
      $page        = $request->get('page');
      $offset      = ($page - 1) * 10;
      $data        = Visit::select('id');

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
