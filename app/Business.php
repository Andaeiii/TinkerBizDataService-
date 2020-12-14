<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class Business extends Basemodel{

	protected $table = 'business';
	protected $guarded = [];

	public function user(){
		return $this->belongsTo('App\User', 'user_id');
	}

    public static function migrate(){
        Schema::dropIfExists('business');
        Schema::create('business', function (Blueprint $table){	
            $table->increments('id');
            $table->integer('user_id');
            $table->string('firstname');
            $table->boolean('has_partner');
            $table->text('partner_info');
            $table->string('address');
            $table->string('mobile');
            $table->integer('is_registered');
            $table->string('cac_number');
            $table->boolean('is_cooperative');
            $table->text('office_address');
            $table->string('office_type');
            $table->string('id_type');
            $table->string('id_number');
            $table->timestamps();
        });



        echo 'Business table / Seeding created successfully.....<br/>';
    }
}
