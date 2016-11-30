<?php

namespace App\Jobs;

use App\Statu;
use App\Cstatu;
use App\Problem;
use App\User;
use App\Problem_User;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class cjudger implements ShouldQueue
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
        $statu = Cstatu::find($this->id);
        $problem = Problem::find($statu->problem_id);
        $user = User::find($statu->user_id);
        $id = $statu->problem_id + 1000;
        $lang = 0;
        if($statu->compiler == "GPP") $lang = 2;
        if($statu->compiler == "GCC") $lang = 1;
        if($statu->compiler == "Java") $lang = 3;
        if($problem->spj == 1)
            $res=exec("./public/Judge/judge -l {$lang} -D ./public/Data/{$id} -d ./public/users/{$user->email}/{$id} -t {$problem->time_limit} -m {$problem->memory_limit} -o 8192 -S dd");
        else
            $res=exec("./public/Judge/judge -l {$lang} -D ./public/Data/{$id} -d ./public/users/{$user->email}/{$id} -t {$problem->time_limit} -m {$problem->memory_limit} -o 8192");

        //file_put_contents("test" , "./public/Judge/judge -l {$lang} -D ./public/Data/{$id} -d ./public/users/{$user->email}/{$id} -t 1000 -m 65535 -o 8192");
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
            
        }

        $statu->running_memory = $memory_usage;
        $statu->running_time = $time_usage;
        $statu->save();
    }
}
