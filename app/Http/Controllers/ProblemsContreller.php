<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Problem;

class ProblemsContreller extends Controller
{
    //
    public function index(){
        $problems = Problem::paginate(100);
        return view('problems.home',compact('problems'));
    }

    public function show($id){
        $id=$id-1000;
        $problem = Problem::find($id);
        return view('problems.show' , compact('problem'));
    }

    public function submit($id){
        $id=$id-1000;
        $problem = Problem::find($id);
        return view('problems.submit' , compact('problem'));
    }
}
