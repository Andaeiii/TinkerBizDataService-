<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Basemodel{
    
    protected $table = "states";

    public $timestamps = false;

    public function lgas(){
    	return $this->hasMany('App\Lga', 'state_id');
    }

    public static function migrate(){
    	echo 'No Migrate...pass....';
    }
  
}
