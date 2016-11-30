<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    //
    public function problems(){
        return $this->belongsToMany('App\Problem','contest_problem');
    }

    public function status(){
    	return $this->belongsToMany('App\Cstatu' , 'contest_cstatus');
    }
}
