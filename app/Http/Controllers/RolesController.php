<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {try {
        $res = Role::get();

        $response['data']=$res;
        $response['status'] = 1;
        $response['message'] = 'Success';
        $response['code'] = 200;
        return response()->json($response);

    }catch (\Exception $e){
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
        $role=Role::where('name',$request['name'])->first();
        if($role){
            $response['status']=0;
            $response['message']='Role Already Exist';
            $response['code']=409;
        }
        else{
            $role =Role::create($request->all());
            $response['status']=1;
            $response['message']='Role Created Successfully';
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
            try {
            $res = Role::find($id);
            if ($res) {
                $response['data'] = $res;
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
            $res = Role::find($id);
            if(is_null($res)){
                $response['status'] = 1;
                $response['message'] = 'Role Not Exist';
                $response['code'] = 409;
            }
            else{
                $res->update($request->all());
                $response['status'] = 1;
                $response['message'] = 'Role Updated Successfully';
                $response['code'] = 200;
            }
            return response()->json($response);

        }catch (QueryException $e){
            $response['status'] = 0;
            $response['data']=null;
            $response['code']=500;
            $response['message']='Error pleas ask admin';

            return response()->json( $response);
            //
        }
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
            $res = Role::findOrFail($id);
            $success =$res->delete();
            if($success){
                $response['status'] = 1;
                $response['message'] = 'Role Deleted Successfully';
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
        //
    }
}
