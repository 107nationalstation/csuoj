<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Statu;
use App\Problem;
use App\User;
use App\Problem_User;
use App\Jobs\judger;

class SubmitController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function submit_page($id){
        $id=$id-1000;
        $problem = Problem::find($id);
        return view('problems.submit' , compact('problem'));
    }

    //
    public function submit(Request $request){
        //submit your code;
        $this->validate($request, [
            'code' => 'required', // 必填
        ]);

        $statu = new Statu;
        $statu->problem_id = $request->get('problem_id');
        $statu->user_id = $request->get('user_id');
        $statu->user_name = $request->get('user_name');
        $statu->statue = 'waiting';
        $statu->running_time = 0;
        $statu->running_memory = 0;
        $statu->compiler = $request->get('compiler');
        $statu->code_length = strlen($request->get('code'));
        $statu->code = $request->get('code');
        $statu->save();

        //$user = User::find($statu->user_id);
        //echo $user->name;
        //exit();

        $id = $statu->problem_id + 1000;
        if(!file_exists("./users/{$statu->user_name}/{$id}")) mkdir("./users/{$statu->user_name}/{$id}");
        if($statu->compiler == "GPP") $file = "./users/{$statu->user_name}/$id/Main.cpp";
        if($statu->compiler == "GCC") $file = "./users/{$statu->user_name}/$id/Main.c";
        if($statu->compiler == "Java") $file = "./users/{$statu->user_name}/$id/Main.java";
        file_put_contents($file , $statu->code);


        dispatch(new judger($statu->id));

        $problem = Problem::find($request->get('problem_id'));
        $problem->submit = $problem->submit + 1;
        $problem->save();

        return redirect('status');
    }
}
