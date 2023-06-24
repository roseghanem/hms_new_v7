<?php

namespace App\Http\Controllers;

use App\Models\BloodGroup;
use App\Models\OutPatient;
use App\Models\Patient;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class OutPatientsController extends Controller
{
//

    public function index()
    {
        $data=OutPatient::join('patients','patients.id','=','out_patients.patient_id')
            ->join('blood_groups', 'blood_groups.id', '=', 'out_patients.blood_group_id')
            ->get(['patients.first_name', 'patients.father_name', 'patients.last_name', 'patients.mother_name','patients.gender','patients.hospital_number','blood_groups.name','out_patients.id']);
        return view('dashboard.out_patients.index', compact('data'));
    }
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data=OutPatient::join('patients','patients.id','=','out_patients.patient_id')
                ->join('blood_groups', 'blood_groups.id', '=', 'out_patients.blood_group_id')
            ->select(['patients.first_name', 'patients.father_name', 'patients.last_name',
                'patients.mother_name','patients.gender','patients.hospital_number',
                'blood_groups.name','out_patients.id',
                'patients.birth_place', 'patients.birth_date', 'patients.city',
                'patients.code', 'patients.address', 'patients.national_number', 'patients.identity_number',

                ])->get();
           return Datatables::of($data)
               ->make(true);
        }
        $columns = ['patients.first_name','patients.last_name','blood_groups.name'];
        if ($request->ajax()) {
            $query = Patient::join('out_patients', 'patients.id', '=', 'out_patients.patient_id')
                ->join('blood_groups', 'blood_groups.id', '=', 'out_patients.blood_group_id')
                ->select(['patients.id as id',
                    'patients.first_name as first_name',
                    'patients.last_name as last_name',
                    'blood_groups.name as  blood_name',
                ]);

            if ($request->search_query != "") {
                //dd("srfegv");
                //echo 'd';exit();
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
        }
    }
    public function create($is_exist)
    {
        if($is_exist){
            return view('dashboard.out_patients.add');
        }
        else{
            return view('dashboard.out_patients.add_existed');
        }

    }
    public function store(Request $request)
    {
        $patient = Patient::where('national_number', $request['national_number'])->first();
        $patient2 = Patient::where([
            ['first_name', '=', $request['first_name']],
            ['father_name', '=', $request['father_name']],
            ['last_name', '=', $request['last_name']],
            ['mother_name', '=',$request['mother_name']],
            ['birth_date', '=', $request['birth_date']],
        ])->first();

        if ($patient||$patient2) {
            if($patient){
                $id = $patient->id;
            }
            else{
                $id = $patient2->id;
            }
            $response['status'] = 0;
            $response['message'] = 'Patient Already Exist';
            $response['code'] = 409;
        } else {
            $patient3 =Patient::create($request->all());
            $id = $patient3->id;
        }

        $outpatient = OutPatient::where('patient_id',$id)->first();
        if($outpatient){
            $response['status'] = 0;
            $response['message'] = 'Out Patient Already Exists';
            $response['code'] = 409;

        }
        else{
            $outpatient = OutPatient::create([
                'patient_id' => $id,
                'blood_group_id' =>$request->blood_group_id,
            ]);
            $response['status'] = 1;
            $response['message'] = 'Out Patient added successfully';
            $response['code'] = 200;

        }

        //return response()->json( $response);
        return  redirect('/out_patients');

        //
    }


    public function store_exist(Request $request)
    {


        $outpatient = OutPatient::where('patient_id',$request->patient_id)->first();
        if($outpatient){
            $response['status'] = 0;
            $response['message'] = 'Out Patient Already Exists';
            $response['code'] = 409;

        }
        else{
            $outpatient = OutPatient::create([
                'patient_id' => $request->patient_id,
                'blood_group_id' =>$request->blood_group_id,
            ]);
            $response['status'] = 1;
            $response['message'] = 'Out Patient added successfully';
            $response['code'] = 200;

        }

        //return response()->json( $response);
        return  redirect('/out_patients');

        //
    }
//    public function getData(Request $request)
//    {
//        if ($request->ajax()) {
//            $data = OutPatient::join('patients','patients.id','=','out_patients.patient_id')
//            ->select(['first_name','father_name','last_name','mother_name','gender','hospital_number','blood_group_id'])->get();
//            return Datatables::of($data)
//                ->make(true);
//        }
//
//    }
//    public function create()
//    {
//        return view('dashboard.out_patients.add');
//    }
//
//
    public function edit($id)
    {
        $out_patient = OutPatient::find($id);
        return view('dashboard.out_patients.edit',compact('out_patient'));
    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
//     */
//    public function store(Request $request)
//    {
//        $columns = ['first_name','last_name','father_name','mother_name','gender','hospital_num','blood_name'];
//        if ($request->ajax()) {
//            $query  = Patient::join('out_patients', 'patients.id', '=', 'out_patients.patient_id')
//               ->join('blood_groups', 'blood_groups.id', '=', 'out_patients.blood_group_id')
//                ->select(['patients.id as id',
//                  'patients.first_name as first_name',
//                   'patients.last_name as last_name',
//                    'patients.father_name as father_name',
//                    'patients.mother_name as mother_name',
//                    'patients.gender as gender',
//                    'patients.hospital_number as hospital_num',
//                   'blood_groups.name as  blood_name',
//                ]); return DataTables::of($query)
//               ->make(true);
//       }
//
//        $outPatient = OutPatient::where('first_name',$request['first_name'])->first();
//
//        if($outPatient){
//             $response['status']=0;
//             $response['message']='OutPatient Already Exist';
//             $response['code']=409;
//         }
//        else{
//            $clinic =OutPatient::create([
//                "first_name"=>$request->first_name,
//                "last_name"=>$request->last_name,
//                "father_name"=>$request->father_name,
//                "mother_name"=>$request->mother_name,
//                "gender"=>$request->gender,
//                "hospital_number"=>$request->hospital_number,
//                "patient_id"=>$request->patient_id,
//                "blood_group_id"=>$request->blood_group_id
//            ]);
//             $response['status']=1;
//             $response['message']='OutPatient Created Successfully';
//             $response['code']=200;
//
//        }
//        //return response()->json( $response);  //
//        return redirect('/out_patients');
//    }




//        if($out_patient){
//            $response['status']=0;
//            $response['message']='Out Patient Already Exist';
//            $response['code']=409;
//        }
//        else{
//            $out_patient =OutPatient::create($request->all());
//            $response['status']=1;
//            $response['message']='Out Patient Created Successfully';
//            $response['code']=200;
//
//        }
//        //return response()->json( $response);
//        return  redirect('/out_patients');
//
//        //
//    }

//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
//     */
//    public function index()
//    {
//        $out_patients = OutPatient::all();
//        return view('dashboard.out_patients.index',compact('out_patients'));
//
//      /*  try {
//            $outPatient = OutPatient::with(['bloodGroup:id,name'])->get();
//
//
//            $response['data']=$outPatient;
//            $response['status'] = 1;
//            $response['message'] = 'Success';
//            $response['code'] = 200;
//            return response()->json($response);
//
//        }catch (QueryException $e){
//            $response['data']=null;
//            $response['code']=500;
//            $response['message']='Error';
//
//            return response()->json( $response);*/
//
//    }
//    public function getData(Request $request)
//    {
//        $columns = ['patients.first_name','patients.last_name','blood_groups.name'];
//        if ($request->ajax()) {
//            $query  = Patient::join('out_patients', 'patients.id', '=', 'out_patients.patient_id')
//           ->join('blood_groups', 'blood_groups.id', '=', 'out_patients.blood_group_id')
//            ->select(['patients.id as id',
//            'patients.first_name as first_name',
//            'patients.last_name as last_name',
//                'blood_groups.name as  blood_name',
//           ]);
////        $query = DB::table('Patient')
////            ->join('out_patients', 'patients.id', '=', 'out_patients.patient_id')
////            ->join('blood_groups', 'blood_groups.id', '=', 'out_patients.blood_group_id')
////            ->select(['out_patients.id as id',
////                'patients.first_name as first_name',
////                'patients.last_name as last_name'])->get();
//////
////            if ($request->search_query != "") {
////                //dd("srfegv");
////                //echo 'd';exit();
////                $whereCluase = "( ";
////                foreach ($columns as $column) {
////                    $whereCluase .=  $column . " LIKE '%" . $this->search_query . "%' OR ";
////                }
////                //delete last OR in whereCluause
////                $whereCluase = substr($whereCluase, 0, strlen($whereCluase) - 3) . " )";
////                $query = $query->whereRaw(DB::raw($whereCluase));
////
////                $recordsFiltered = $query->count('*');
////                return $this;
////            }
//
//            return DataTables::of($query)
//
//                ->make(true);
//        }
//    }
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
//
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
//     */
//    public function create()
//    {
//        $patient_ids = Patient::select(['id','first_name','father_name','last_name','mother_name','gender'])->get();
//        $blood_ids = BloodGroup::select(['id','name'])->get();
//
//        return view('dashboard.out_patients.add',compact('patient_ids','blood_ids'));
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
//     */
//    public function store(Request $request)
//    {
////        $columns = ['patients.first_name','patients.last_name','blood_groups.name'];
////        if ($request->ajax()) {
////            $query  = Patient::join('out_patients', 'patients.id', '=', 'out_patients.patient_id')
////                ->join('blood_groups', 'blood_groups.id', '=', 'out_patients.blood_group_id')
////                ->select(['patients.id as id',
////                    'patients.first_name as first_name',
////                    'patients.last_name as last_name',
////                    'blood_groups.name as  blood_name',
////                ]); return DataTables::of($query)
////
////                ->make(true);
////        }
//               $outpatient = new Patient();
//               $outpatient->patient_id = $request->patient_id;
//               $outpatient->first_name = $request->first_name;
//                $outpatient->father_name = $request->father_name;
//                $outpatient->last_name = $request->last_name;
//                $outpatient->mother_name = $request->mother_name;
//                $outpatient->gender = $request->gender;
//                $outpatient->hospital_number = $request->hospital_number;
//               $outpatient->blood_group_id = $request->blood_group_id;
//               $outpatient->save();
//        // $outPatient=OutPatient::where('name',$request['name'])->first();
//        // if($outPatient){
//        //     $response['status']=0;
//        //     $response['message']='OutPatient Already Exist';
//        //     $response['code']=409;
//        // }
//        //else{
////            $clinic =OutPatient::create([
////                "patient_id"=>$request->patient_id,
////                "blood_group_id"=>$request->blood_group_id
////            ]);
//            // $response['status']=1;
//            // $response['message']='OutPatient Created Successfully';
//            // $response['code']=200;
//
//        //}
//        //return response()->json( $response);  //
//        return redirect('/out_patients');
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
//     */
    public function show($id)
    {
        $outPatient = OutPatient::with(['bloodGroup:id,name'])->find($id);
        if($outPatient) {
            $response['data']= $outPatient;
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
        } //
    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//        $out_patient = OutPatient::find($id);
//        return view('dashboard.out_patients.edit',compact('out_patient'));
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
//     */
    public function update(Request $request, $id)
    {

        try {
            $outPatient = OutPatient::find($id);
            if(is_null($outPatient)){
                $response['status'] = 1;
                $response['message'] = 'OutPatient is Not Exist';
                $response['code'] = 409;
            }
            else{
                $outPatient->update([
                    'blood_group_id' => $request->blood_group_id
                ]);
                $response['status'] = 1;
                $response['message'] = 'OutPatient Updated Successfully';
                $response['code'] = 200;
            }
            //return response()->json($response);
//            return redirect('/out_patients');

                $patient = Patient::find($outPatient->patient_id);
//            $patient = $outPatient->Patient;
                if(is_null($patient)){
                    $response['status'] = 1;
                    $response['message'] = 'Patient Not Exist';
                    $response['code'] = 409;
                }
                else{
                    $patient->update($request->all());
                    $response['status'] = 1;
                    $response['message'] = 'Patient Updated Successfully';
                    $response['code'] = 200;
                }
//                return response()->json($response);
            return  redirect('/out_patients');


        }
        catch (QueryException $e){
            $response['status'] = 0;
            $response['data']=null;
            $response['code']=500;
            $response['message']='Error please ask admin';

            //return response()->json( $response);
            return redirect('/out_patients');

        }   //
    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
//     */
    public function destroy($id)
    {

        try {
//            $success = OutPatient::find($id);
//                DB::table('out_patients')->where('id',$id)->delete();
            $outPatient = OutPatient::findorFail($id);
            $success = $outPatient->delete();

            if($success){
                $response['status'] = 1;
                $response['message'] = 'OutPatient Deleted Successfully';
                $response['code'] = 200;
//                return response()->json($response);
                return  redirect('/out_patients');
            }
            else{
                $response['status'] = 0;
                $response['message'] = 'Error';
                $response['code'] = 500;
                //return response()->json($response);
                return  redirect('/out_patients');
            }


        }catch (QueryException $e){
            $response['data']=null;
            $response['code']=500;
            $response['message']='Error please ask admin';
            //return response()->json( $response);
            return redirect('/out_patients');
        }

    }
//
//
////    public function deleteAll(){
////        DB::table('out_patients')->delete();
////        return redirect('/out_patients');
//////        return response('deleted successfully');
////    }
//
    public function select(Request $request)
    {
      $page        = $request->get('page');
      $offset      = ($page - 1) * 10;
      $data        = OutPatient::join('patients','patients.id','=','out_patients.patient_id')
      ->select('out_patients.id', 'patients.first_name','patients.last_name');

      if($request->term != null){
        $data = $data->where(function($query) use($request){
          $query =	$query->whereRaw( DB::raw( "LOWER(first_name) LIKE '%".$request->term."%'") )  ;
        });
      }
//
//
//
//
      $totalRows =  $data->count();
      $lastRow   =  $offset + 10;
      $morePages =  $lastRow < $totalRows;
      $data      =  $data->orderBy('id')->skip($offset)->take(10)->get();

      $results = [
        "results"    => $data->map(function($item){
          return [
            "id"   =>  $item['id'] ,
            "text" =>  ($item['id'] ." ".$item['first_name'] ." ".$item['last_name']),
          ];
        }),
        "pagination" => ["more" => $morePages ]
      ];

      return response()->json($results);
    }
}
