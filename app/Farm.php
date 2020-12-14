<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class Farm extends Basemodel{

	protected $table = 'farms';
	protected $guarded = [];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function analytics(){
        return $this->hasOne('App\Analytics', 'farm_id');
    }

    public function yeilds(){
        return $this->hasMany('App\Yields', 'farm_id');
    }

    public static function migrate(){
        Schema::dropIfExists('farms');
        Schema::create('farms', function (Blueprint $table){	
            $table->increments('id');
            $table->integer('user_id');
            $table->string('farmsize');
            $table->integer('staff_count')->nullable();
            $table->text('description')->nullable();
            $table->text('operations')->nullable();
            $table->string('coordinates');
            $table->timestamps();
        });
        echo 'Farms table / Seeding created successfully.....<br/>';
    }

}
