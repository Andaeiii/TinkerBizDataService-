<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class FarmYield extends Basemodel{

	protected $table = 'yields';
	protected $guarded = [];

    public function farm(){
        return $this->belongsTo('App\Farm', 'farm_id');
    }

    public function valueChain(){
        return $this->hasMany('App\ValueChain', 'valuechain_id');
    }

    public static function migrate(){

        Schema::dropIfExists('farm_yields');

        Schema::create('farm_yields', function (Blueprint $table){	

            $table->increments('id');
            $table->integer('farm_id');

            $table->integer('valuechain_id');

            $table->string('expected_yield');
            $table->string('quantity');    //per scale.. 

            $table->string('item_scale');  //how you choose to pack it. in bags, or 
            $table->string('est_revenue');
            $table->string('description');

            $table->timestamps();

        });

        echo 'Yields table / Seeding created successfully....  ';

    }

}
