<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class Analytics extends Basemodel{

	protected $table = 'farm_analytics';
	protected $guarded = [];

    public $timestamps = false;

    public function farm(){
        return $this->belongsTo('App\Farm', 'farm_id');
    }

    public static function migrate(){
        Schema::dropIfExists('farm_analytics');
        Schema::create('farm_analytics', function (Blueprint $table){	
            $table->increments('id');
            $table->integer('farm_id');
            $table->string('worth_value');
            $table->string('revenue_month');
            $table->string('target_market');
            $table->text('constraints');
            $table->text('interventions');
            $table->timestamps();
        });



        echo 'Farm Analytics table / Seeding created successfully.....<br/>';
    }
}
