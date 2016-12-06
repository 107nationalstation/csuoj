<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paste;

class PasteController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	return view('paste.home');
    }

    public function upload(Request $request){    	
    	$this->validate($request, [
            'content' => 'required',
        ]);

    	$paste = new Paste;
    	$paste->user_id = request('user_id');
    	$paste->title = request('user_name');
    	$paste->content = request('content');
    	$paste->save();
    	return redirect("paste/$paste->id");
    }

    public function show($id){
    	$paste = Paste::find($id);

    	return view('paste.show' , compact('paste'));
    }
}
