<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class DeviceController extends Controller
{
    //
    public function list()
    {
        # code...
        return Device::all();
    }
    public function listid($id=null)
    {
        # code...
        return $id?Device::find($id):Device::all();
    }
}
