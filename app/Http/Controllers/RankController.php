<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RankController extends Controller
{
    //
    public function index(){
        $users = User::orderBy('solved','desc')->paginate(100);
        return view('rank.home',compact('users'));
    }
}
