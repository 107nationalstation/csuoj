<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contest;
use App\Problem;
use App\Cstatu;
use App\User;
use App\Problem_User;
use App\Jobs\cjudger;
use App\Jobs\MyJob;

class ContestsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$contests = Contest::latest('id')->paginate(100);
        return view('contests.home',compact('contests'));
    }

    public function show($id){
    	$contest = Contest::find($id);
    	$problems = $contest->problems;
        $submit = Array(0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0);
        $accepted = Array(0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0);
        $index = 0;
        $cstatus = Cstatu::where('contest_id' , '=' , $id)->get();
        foreach($problems as $problem){
            foreach($cstatus as $cstatu){
                if($cstatu->problem_id == $problem->id){
                    $submit[$index]++;
                    if($cstatu->statue == "Accepted") $accepted[$index]++;
                }
            }
        }
    	return view('contests.show' , compact('contest' , 'problems' , 'submit' , 'accepted' , 'id'));
    }

    public function show_problem($id , $problem_tag){
        $contest = Contest::find($id);
        $problems = $contest->problems;
        $problem = new Problem;
        $index = 65;
        foreach($problems as $tmp_problem){
            if(chr($index) == $problem_tag){
                $problem = $tmp_problem;
                break;
            }
            $index ++;
        }
        return view('contests.show_problem' , compact('problem' , 'contest' , 'problem_tag'));
    }

    public function submit_page($id , $problem_tag){
        $contest = Contest::find($id);
        $problems = $contest->problems;
        $problem = new Problem;
        $index = 65;
        foreach($problems as $tmp_problem){
            if(chr($index) == $problem_tag){
                $problem = $tmp_problem;
                break;
            }
            $index ++;
        }
        return view('contests.submit' , compact('problem' , 'contest' , 'problem_tag'));
    }

    public function submit(Request $request){
        //submit your code;
        $this->validate($request, [
            'code' => 'required', // 必填
        ]);

        $statu = new Cstatu;
        $statu->contest_id = $request->get('contest_id');
        $statu->problem_id = $request->get('problem_id');
        $statu->problem_tag = $request->get('problem_tag');
        $statu->user_id = $request->get('user_id');
        $statu->user_name = $request->get('user_name');
        $statu->statue = 'waiting';
        $statu->running_time = 0;
        $statu->running_memory = 0;
        $statu->compiler = $request->get('compiler');
        $statu->code_length = strlen($request->get('code'));
        $statu->code = $request->get('code');
        $statu->save();
        $id = $statu->problem_id + 1000;
        if(!file_exists("./users/{$statu->user_name}/{$id}")) mkdir("./users/{$statu->user_name}/{$id}");
        if($statu->compiler == "GPP") $file = "./users/{$statu->user_name}/$id/Main.cpp";
        if($statu->compiler == "GCC") $file = "./users/{$statu->user_name}/$id/Main.c";
        if($statu->compiler == "Java") $file = "./users/{$statu->user_name}/$id/Main.java";
        file_put_contents($file , $statu->code);

        dispatch(new cjudger($statu->id));

        return redirect('contests/'.$statu->contest_id.'/status/now');
    }

    public function status($id){
        $contest = Contest::find($id);
        $status = Cstatu::where('contest_id' , '=' , $id)->paginate(100);
        return view('contests.status' , compact('status' , 'id' , 'contest'));
    }

    public function rank($id){
        $contest = Contest::find($id);
        $status = Cstatu::where('contest_id' , '=' , $id)->get();
        $users = array();
        $index_user = 0;
        foreach($status as $statu){
            $users[$index_user] = $statu->user_name;
            $index_user ++;
        }
        $users = array_unique($users);//用户
        $users_tmp = array();
        $index_user = 0;
        foreach($users as $user){
            $users_tmp[$index_user] = $user;
            $index_user ++;
        }
        //var_dump($users_tmp);
        //exit();
        //$user = $users_tmp;
        $index_user = 0;
        foreach($users_tmp as $users_tmp){
            $users[$index_user] = $users_tmp;
            $index_user ++;
        }

        $problems = $contest->problems;//问题
        $hashproblem = array();
        $index_problem = 0;
        foreach($problems as $problem){
            $index_problem ++;
        }

        $no_ac_time = array();
        $is_ac = array();
        $penalty = array();
        foreach($users as $user){
            foreach($problems as $problem){
                $is_ac[$user][$problem->id] = 0;
                $no_ac_time[$user][$problem->id] = 0;
            }
            $penalty[$user] = 0;
        }
        foreach($status as $statu){
            if($statu->statue == "Accepted"){
                if($is_ac[$statu->user_name][$statu->problem_id] != 1){
                    $penalty[$statu->user_name] += 20 * $no_ac_time[$statu->user_name][$statu->problem_id];
                    $penalty[$statu->user_name] += floor((strtotime($statu->created_at) - strtotime($contest->start_time)) / 60);
                }
                $is_ac[$statu->user_name][$statu->problem_id] = 1;

            }
            else{
                if($is_ac[$statu->user_name][$statu->problem_id] == 0)
                    $no_ac_time[$statu->user_name][$statu->problem_id] ++;
            }
        }

        //var_dump($users);
        //exit();
        for($i = 0 ; $i < $index_user ; ++ $i){
            $user_ac[$i] = 0;
            
            foreach($problems as $problem)
                if($is_ac[$users[$i]][$problem->id] == 1)
                    $user_ac[$i] ++;
        }
        for($i = $index_user - 1 ; $i >= 0 ; -- $i){
            for($j = $i - 1 ; $j >= 0 ; -- $j){
                if($user_ac[$j] < $user_ac[$j + 1]){
                    $tmp = $user_ac[$j + 1];
                    $user_ac[$j + 1] = $user_ac[$j];
                    $user_ac[$j] = $tmp;
                    $tmp = $users[$j + 1];
                    $users[$j + 1] = $users[$j];
                    $users[$j] = $tmp;
                    $tmp = $penalty[$users[$j + 1]];
                    $penalty[$users[$j + 1]] = $penalty[$users[$j]];
                    $penalty[$users[$j]] = $tmp;
                }
                else if($user_ac[$j] == $user_ac[$j + 1] && $penalty[$users[$j]] < $penalty[$users[$j + 1]]){
                    $tmp = $user_ac[$j + 1];
                    $user_ac[$j + 1] = $user_ac[$j];
                    $user_ac[$j] = $tmp;
                    $tmp = $users[$j + 1];
                    $users[$j + 1] = $users[$j];
                    $users[$j] = $tmp;
                    $tmp = $penalty[$users[$j + 1]];
                    $penalty[$users[$j + 1]] = $penalty[$users[$j]];
                    $penalty[$users[$j]] = $tmp;
                }
            }
        }
        
        return view('contests.rank' , compact('index_user' , 'index_problem' , 'problem_user' , 'is_ac' , 'no_ac_time' , 'users' , 'problems' , 'contest' , 'id' , 'user_ac' , 'penalty'));
        exit();
    }
}
