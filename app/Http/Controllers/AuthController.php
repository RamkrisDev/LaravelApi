<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\validator;
use App\Models\User;
use Auth;
class AuthController extends Controller
{
    //

    public function register(Request $request)
    {
        # code...
        $validate=Validator::make($request->all(),[
            'name'=>"required",
            "email"=>"required|email",
            "password"=>"required"

        ]);
        if($validate->fails()){
            return response()->json(['status'=>400,'message'=>"bad request"]);
        }
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->save();
        return response()->json([
            'status'=>200,
            'message'=>'user success',
            'user'=>$user
        ]);
    }
    public function login(Request $request)
    {
        # code...

        $validate=Validator::make($request->all(),[
            "email"=>"required|email",
            "password"=>"required"

        ]);
        if($validate->fails()){
            return response()->json(['status'=>400,'message'=>"bad request"]);
        }
        $credential=request(['email','password']);
        if(!Auth::attempt($credential)){
            return response()->json([
                'status'=>500,
                'message'=>"unauthorised"
            ]);
        }
        $user=User::where('email',$request->email)->first();

        $tokemresult=$user->createToken('authtoken')->plainTextToken;
        //try
        session()->put('token',$tokemresult);

        return response()->json([
            "status"=>200,
            'token'=>$tokemresult
        ]);


    }

    public function logout(Request $request){

        $request->user()->currentAccessToken()->delete();
        return response()->json([
            "status"=>200,
            'message'=>"token deleted"
        ]);
    }
   
}


