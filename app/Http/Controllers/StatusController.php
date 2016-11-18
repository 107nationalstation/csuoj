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

    public function submit(Request $request){
        //submit your code;
        $this->validate($request, [
            'code' => 'required', // 必填
        ]);
        //交给判题的队列


        $statu = new Statu;
        $statu->problem_id = $request->get('problem_id');
        $statu->user_name = $request->get('user_name');
        $statu->statue = 'waiting';
        $statu->running_time = 0;
        $statu->running_memory = 0;
        $statu->compiler = $request->get('compiler');
        $statu->code_length = strlen($request->get('code'));
        $statu->save();
        $solved_problems = User::find($request->get('user_id'))->problems;
        $flag = TRUE;
        foreach($solved_problems as $solved_problem){
            if($solved_problem->id == $request->get('problem_id'))
                $flag = FALSE;
        }
        if($flag){
            $problem_user = new Problem_User;
            $problem_user->problem_id = $request->get('problem_id');
            $problem_user->user_id = $request->get('user_id');
            $problem_user->save();
        }

        $problem = Problem::find($request->get('problem_id'));
        $problem->submit = $problem->submit + 1;
        $problem->save();

        return redirect('status');
    }
}
