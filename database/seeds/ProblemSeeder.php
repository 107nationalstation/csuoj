<?php

use Illuminate\Database\Seeder;

class ProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //DB::table('problems')->delete();

        for($i=0;$i<1000;$i++){
            \App\Problem::create([
                //$table->string('title');
                'title'        => 'title '.$i,
                //$table->integer('time_limit');
                'time_limit'   => 1,
                //$table->integer('memory_limit');
                'memory_limit' => 128,
                //$table->text('description');
                'description'  => '<a href="http://studioflaming.cn">gao</a>',
                //$table->text('input');
                'input'        => 'input '.$i,
                //$table->text('output');
                'output'       => 'output '.$i,
                //$table->text('sample_input');
                'sample_input' => 'sample_input '.$i,
                //$table->text('sample_output');
                'sample_output'=> 'sample_output '.$i,
                //$table->text('hint')->nullable();
                'hint'         => 'hint '.$i,
                //$table->boolean('spj');
                'spj'          => 0,
                //$table->text('source')->nullable();
                //$table->integer('user_id');
                'user_id'      => $i,
                //$table->timestamps();
            ]);
        }
    }
}
