<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MysqlUser as User;

class MysqlController extends Controller
{
    public function index(){
    	// $user = new User;
    	$user = User::where('name', 'L')->get();
		echo User::where('name', 'L')->delete();
    }
    public function read($id){
    	return User::where('id',$id)->get();
    }
    public function create($name){
    	$user = new User;
    	$user->name = $name;
    	$user->save();
    }
    public function update($id,$name){
    	$user = User::find($id);
    	$user->name = $name;
    	$user->save();
    }
    public function delete($id){
    	$user = User::find($id);
    	$user->delete();
    }
}