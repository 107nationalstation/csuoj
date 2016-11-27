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
    public function index(){
        $status = Statu::latest('id')->paginate(100);
        return view('status.home',compact('status'));
    }

    public function show_code($id){
        $statu = Statu::find($id);
        return view('status.show_code' , compact('statu'));
    }
}
