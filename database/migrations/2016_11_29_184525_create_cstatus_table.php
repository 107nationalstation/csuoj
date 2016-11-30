<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCstatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('cstatus', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('problem_id');
            $table->string('user_name');
            $table->string('statue');
            $table->integer('running_time');
            $table->integer('running_memory');
            $table->string('compiler');
            $table->integer('code_length');
            $table->text('code');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
