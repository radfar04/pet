<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DB;

class ValidationController extends Controller {
   public function showform() {
      $d = "Select dbo.kooft()";
      $k = \DB::select('select dbo.dooft(?) as result',array('Ma'));
      return view('signin');
   }
   public function validateform(Request $request) {
      print_r($request->all());
      $this->validate($request,[
         'username'=>'required|max:8',
         'password'=>'required'
      ]);
   }
}