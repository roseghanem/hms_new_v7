<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryType;
use Illuminate\Database\QueryException;


class InventoryTypeController extends Controller
{
    public function index()
    {
        try {
            $res = InventoryType::get();


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

    }
    public function show($id)
    {
        $res = InventoryType::find($id);
        if ($res) {
            $response['data']=$res;
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
        }
    }
    public function store(Request $request)
    {
        try {
            $inventorytype=InventoryType::where('name',$request['name'])->first();
            if ($inventorytype) {
                $response['status'] = 0;
                $response['message'] = 'Inventory Already Exist';
                $response['code'] = 409;
            } else {
                $inventorytype =  InventoryType::create([
                    'name' => $request->name,

                ]);
                $response['status'] = 1;
                $response['message'] = 'Inventory Created Successfully';
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

    public function update(Request $request, $id)
    {
        try {
            $inventorytype = InventoryType::find($id);
            if (is_Null($inventorytype)) {

                $response['status'] = 1;
                $response['message'] = 'Inventory Not Exist';
                $response['code'] = 409;
                return response()->json($response);

            } else {
                $inventorytype->update($request->all());
                $response['status'] = 1;
                $response['message'] = 'Inventory Updated Successfully';
                $response['code'] = 200;
                return response()->json( $response);
            }

        } catch (QueryException $e) {
            $response['data'] = null;
            $response['message'] = 'Error pleas ask admin';
            $response['code'] = 500 ;
            $response['status'] = 0;
            return $response()->json( $response);

        }


    }
}
