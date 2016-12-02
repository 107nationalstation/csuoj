<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Statu;
use App\Problem;
use App\User;
use App\Problem_User;

class StatusController extends Controller
{
    //
    public function index(Request $request){
    	$quest = array();
    	if($request->get('id') != '') $quest['id'] = $request->get('id');
    	if($request->get('problem_id') != '') $quest['problem_id'] = $request->get('problem_id');
    	if($request->get('user_name') != '') $quest['user_name'] = $request->get('user_name');
    	if($request->get('statue') != '') $quest['statue'] = $request->get('statue');
    	if($request->get('compiler') != '') $quest['compiler'] = $request->get('compiler');
        $status = Statu::where($quest)->latest('id')->paginate(100);
        return view('status.home',compact('status'));
    }

    public function show_code($id){
        $statu = Statu::find($id);
        return view('status.show_code' , compact('statu'));
    }
}
