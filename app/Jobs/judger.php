<?php

namespace App\Jobs;

use App\Statu;
use App\Problem;
use App\User;
use App\Problem_User;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class judger implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $id;

    public function __construct($id)
    {
        //
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $statu = Statu::find($this->id);
        $problem = Problem::find($statu->problem_id);
        //file_put_contents("test" , $statu->id);
        $user = User::find(6);
        $id = $statu->problem_id + 1000;
        $res=exec("./public/Judge/judge -l 2 -D ./public/Data/{$id} -d ./public/users/{$statu->user_name}/{$id} -t 1 -m 65536 -o 8192");
        //file_put_contents("test" , $res);
        $result = '';
        $memory_usage = '';
        $time_usage = '';
        $i = 0;
        $len = strlen($res);
        for(; $i < $len ; $i ++)
            if($res[$i] != ' ')
                $result = $result.$res[$i];
            else
                break;
        $i ++;

        for(; $i < $len ; $i ++)
            if($res[$i] != ' ')
                $memory_usage = $memory_usage.$res[$i];
            else
                break;
        $i ++;

        for(; $i < $len ; $i ++)
            if($res[$i] != ' ')
                $time_usage = $time_usage.$res[$i];
            else
                break;
        if($result == 2) $statu->statue = 'Accepted';
        if($result == 3) $statu->statue = 'Presentation Error';
        if($result == 4) $statu->statue = 'Time Limit Exceeded';
        if($result == 5) $statu->statue = 'Memory Limit Exceeded';
        if($result == 6) $statu->statue = 'Wrong Answer';
        if($result == 7) $statu->statue = 'Output Limit Exceeded';
        if($result == 8) $statu->statue = 'Compilation Error';
        if($result == 9) $statu->statue = 'System Error';

        if($result == 2){
            $solved_problems = $user->problems;
            $flag = TRUE;
            foreach($solved_problems as $solved_problem){
                if($solved_problem->id == $statu->problem_id)
                    $flag = FALSE;
            }
            if($flag){
                $problem_user = new Problem_User;
                $problem_user->problem_id = $statu->problem_id;
                $problem_user->user_id = $user->id;
                $problem_user->save();
                $user->solved ++;
                $user->save();
            }

            $problem->accepted ++;
            $problem->save();

        }
        $statu->running_memory = $memory_usage;
        $statu->running_time = $time_usage;
        $statu->save();
    }
}
