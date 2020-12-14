<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lga extends Basemodel{
    
    protected $table = 'lgas';
    
    public $timestamps = false;

    public function state(){
    	return $this->belongsTo('App\State', 'state_id');
    }


    public static function migrate(){
    	echo 'No Migrate...pass....';
    }

}
