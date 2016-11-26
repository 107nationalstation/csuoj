<?php

namespace App\Jobs;

use App\Statu;
use App\Problem;

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
        $id = $statu->problem_id + 1000;
        //file_put_contents("test" , "./public/Judge/judge -l 2 -D ./public/Data/{$id} -d ./public/users/{$statu->user_name}/{$id} -t 1 -m 65536 -o 8192");
        $res=exec("./public/Judge/judge -l 2 -D ./public/Data/{$id} -d ./public/users/{$statu->user_name}/{$id} -t 1 -m 65536 -o 8192");
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
        if($result == 2) $statu->statue = 'AC';
        if($result == 3) $statu->statue = 'PE';
        if($result == 4) $statu->statue = 'TLE';
        if($result == 5) $statu->statue = 'MLE';
        if($result == 6) $statu->statue = 'WA';
        if($result == 7) $statu->statue = 'OLE';
        if($result == 8) $statu->statue = 'CE';
        if($result == 9) $statu->statue = 'SF';
        $statu->running_memory = $memory_usage;
        $statu->running_time = $time_usage;
        $statu->save();
    }
}
