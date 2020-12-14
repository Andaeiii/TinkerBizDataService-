<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class FarmVC extends Basemodel{

	protected $table = 'farm_valuechains';
	protected $guarded = [];


    public function farm(){
        return $this->belongsTo('App\Farm', 'category_id');
    }

    public function valueChain(){
        return $this->hasMany('App\ValueChain', 'valuechain_id');
    }

    public static function migrate(){
        Schema::dropIfExists('farm_valuechains');
        Schema::create('farm_valuechains', function (Blueprint $table){	

            $table->increments('id');
            $table->integer('farm_id');
            $table->integer('valuechain_id');
            $table->timestamps();

        });

        echo 'Farm ValueChains table / Seeding created successfully.....<br/>';
    }
}
