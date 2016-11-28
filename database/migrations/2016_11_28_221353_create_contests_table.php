<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('contests', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->time('time_limit');
            $table->time('memory_limit');
            $table->text('description');
            $table->text('input');
            $table->text('output');
            $table->text('sample_input');
            $table->text('sample_output');
            $table->text('hint')->nullable();
            $table->boolean('spj');
            $table->text('source')->nullable();
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
