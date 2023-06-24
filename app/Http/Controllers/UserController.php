<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class UserController extends Controller
{
    public function register(Request $request)
    {
        $user=User::where('email',$request['email'])->first();
        if($user){
            $response['status']=0;
            $response['message']='User Already Exist';
            $response['code']=409;
        }
        else{
            $user =User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' =>bcrypt($request->password)
            ]);
            $response['status']=1;
            $response['message']='User Registerd Successfully';
            $response['code']=200;

        }
        return response()->json( $response);

    }

    public function login(Request $request){
        $credentials=$request->only('email','password');
        try {
            if(!JWTAuth::attempt($credentials)){

                $response['data']=null;
                $response['status']=0;
                $response['code']=401;
                $response['message']='Email or password is incorrect';
                return response()->json( $response);
            }

        }catch (JWTException $e){
            $response['data']=null;
            $response['code']=500;
            $response['message']='Could not create token';

            return response()->json( $response);
        }
        $user=auth()->user();
        $data['token']=auth()->claims([
            'user_id'=>$user->id,
            'user_email'=>$user->email,
            'user_name'=>$user->name,
        ])->attempt($credentials);
        $response['data']=$data;
        $response['status']=1;
        $response['code']=200;
        $response['message']='Login Successfully';

        return response()->json( $response);

    }









    public function index()
    {
        try {
            $users = User::all();
            $response['data']=$users;
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



    public function store(Request $request)
    {
        $user=User::where('email',$request['email'])->first();
        if($user){
            $response['status']=0;
            $response['message']='User Already Exist';
            $response['code']=409;
        }
        else{
            $user =User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' =>bcrypt($request->password)
            ]);
            $response['status']=1;
            $response['message']='User Registerd Successfully';
            $response['code']=200;

        }
        return response()->json( $response);

    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            $response['data']=$user;
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




    public function update( Request $request,$id)
    {
        try {
            $user = User::find($id);
            if(is_null($user)){
                $response['status'] = 1;
                $response['message'] = 'User Not Exist';
                $response['code'] = 409;
            }
            else{
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' =>bcrypt($request->password)
                ]);
                $response['status'] = 1;
                $response['message'] = 'User Updated Successfully';
                $response['code'] = 200;
            }
            return response()->json($response);

        }catch (QueryException $e){
            $response['status'] = 0;
            $response['data']=null;
            $response['code']=500;
            $response['message']='Error please ask admin';

            return response()->json( $response);
        }



        //
    }



    public function destroy($id)
    {

        try {
            $user = User::findOrFail($id);
            $success =$user->delete();
            if($success){
                $response['status'] = 1;
                $response['message'] = 'User Deleted Successfully';
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
    //
}
