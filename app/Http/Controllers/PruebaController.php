<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebaController extends Controller {

    public function index($UID)
    {
        //$UID  = $request->input('UID');

        $users = \DB::select("select * from obras where UID = '$UID'");
        return view('image.demo', ['users' => $users]);
    }

}
