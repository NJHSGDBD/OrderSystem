<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function showRequest(Request $request){
    	dd($request->all());
    }
    public function view(Request $request){
    	return view('test.testView',['res'=>$request->all()]);
    }
}
