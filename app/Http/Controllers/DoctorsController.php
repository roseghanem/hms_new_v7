<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Comment\Doc;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $res = Doctor::select("*")
                ->orderBy('created_at', 'desc')
                ->get();

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

        try {
            $doctor = Doctor::where('national_number', $request['national_number'])->first();




            $doctor2 = Doctor::where([
                ['first_name', '=', $request['first_name']],
                ['father_name', '=', $request['father_name']],
                ['last_name', '=', $request['last_name']],
                ['mother_name', '=',$request['mother_name']],
                ['birth_date', '=', $request['birth_date']],
            ])->first();





            if ($doctor||$doctor2) {
                $response['status'] = 0;
                $response['message'] = 'Already Exist';
                $response['code'] = 409;
            } else {
                $doctor = Doctor::create([
                    'first_name' => $request->first_name,
                    'father_name' => $request->father_name,
                    'last_name' => $request->last_name,
                    'mother_name' => $request->mother_name,
                    'birth_place' => $request->birth_place,
                    'birth_date' => $request->birth_date,
                    'city' => $request->city,
                    'code' => $request->code,
                    'gender' => $request->gender,
                    'address' => $request->address,
                    'national_number' => $request->national_number,
                    'identity_number' => $request->identity_number,
                    'hospital_number' => $request->hospital_number,
                ]);
                $response['status'] = 1;
                $response['message'] = ' Created Successfully';
                $response['code'] = 200;

            }
            return response()->json($response);

        }catch (QueryException $e){
            $response['data']=null;
            $response['code']=500;
            $response['message']='Error please ask admin';

            return response()->json( $response);
        }
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
        try {
            $doctor = Doctor::find($id);
            if ($doctor) {
                $response['data'] = $doctor;
                $response['status'] = 1;
                $response['message'] = 'Success';
                $response['code'] = 200;
                return response()->json($response);
            } else {
                $response['data'] = null;
                $response['code'] = 404;
                $response['message'] = 'Not Found';
                return response()->json($response);
            }
        }
        catch (QueryException $e){
            $response['status'] = 0;
            $response['data']=null;
            $response['code']=500;
            $response['message']='Error pleas ask admin';

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
            $doctor = Doctor::find($id);
            if(is_null($doctor)){
                $response['status'] = 1;
                $response['message'] = ' Not Exist';
                $response['code'] = 409;
            }
            else{
                $doctor->update($request->all());
                $response['status'] = 1;
                $response['message'] = 'Updated Successfully';
                $response['code'] = 200;
            }
            return response()->json($response);

        }catch (QueryException $e){
            $response['status'] = 0;
            $response['data']=null;
            $response['code']=500;
            $response['message']='Error pleas ask admin';

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
            $res = Doctor::findOrFail($id);
            $success =$res->delete();
            if($success){
                $response['status'] = 1;
                $response['message'] = ' Deleted Successfully';
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
            $response['message']='Error';
            return response()->json( $response);
        }

        //
    }

    public function select(Request $request)
    {
      $page        = $request->get('page');
      $offset      = ($page - 1) * 10;
      $data        = Doctor::select('id', 'first_name','last_name');

      if($request->term != null){
        $data = $data->where(function($query) use($request){
          $query =	$query->whereRaw( DB::raw( "LOWER(first_name) LIKE '%".$request->term."%'") )  ;
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
            "text" =>  ($item['id'] ." ".$item['first_name'] ." ".$item['last_name']),
          ];
        }),
        "pagination" => ["more" => $morePages ]
      ];

      return response()->json($results);
    }
}
