<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use Validator;
class Devicepost extends Controller
{
    //
    public function add(Request $req)
    {
        $device=new Device();
        $device->name=$req->name;
        $device->memid=$req->memid;
        $res=$device->save();
        if($res){

        # code...
        return ["result"=>"success"];
        }
        else{
            return ["result"=>"falied"];
        }
    }

    public function upd(Request $req)
    {
        # code...
        $dev=Device::find($req->id);
        $dev->name=$req->name;
        $dev->memid=$req->memid;
        $res=$dev->save();

        if($res)
        return ['result'=>"ok"];
    }


    public function search($name)
    {
        # code...
        // return Device::where('name',$name)->get();
        return Device::where('name',"like","%".$name."%")->get();
    }
    function delete($id){
        $result= Device::find($id);
        $res=$result->delete();
if($res)
        return ['status'=>"deleted"];
    }





    //test
    public function testapp(Request $req)
    {
        # code...

        $rules=array(
            'memid'=>'required | min:1 | max:3'
        );
        $valid=Validator::make($req->all(),$rules);

        if($valid->fails()){
            return $valid->errors();
        }
        return ["x"=>"Y"];
    }
}
