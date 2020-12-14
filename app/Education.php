<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class Education extends Basemodel{

	protected $table = 'school_educations';
	protected $guarded = [];

	public function Profile(){
		return $this->belongsTo('App\Profile', 'profile_id');
	}

    public static function migrate(){
        Schema::dropIfExists('school_educations');
        Schema::create('school_educations', function (Blueprint $table){	

            $table->increments('id');
            $table->integer('profile_id');
            $table->string('SchoolName');
            $table->string('description');
            $table->string('YearCompleted', 4);
            $table->string('Qualification');
            $table->timestamps();

        });

        echo 'ValueChains table / Seeding created successfully.....<br/>';
    }
}
