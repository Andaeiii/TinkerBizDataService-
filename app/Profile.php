<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class Profile extends Basemodel{

	protected $table = 'profiles';
	protected $guarded = [];

	public function user(){
		return $this->belongsTo('App\User', 'user_id');
	}

    public function lga(){
        return $this->hasOne('App\Lga', 'user_id');
    }

    public function Education(){
        return $this->hasMany('App\Education', 'education_id');
    }

    public static function migrate(){
        Schema::dropIfExists('profiles');
        Schema::create('profiles', function (Blueprint $table){	

            $table->increments('id');

            $table->integer('user_id');
            $table->integer('education_id')->nullable();
            $table->integer('lga_id')->default(123);

            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('mobile')->nullable();
            $table->date('dateofbirth')->nullable();
            $table->string('gender')->nullable();
            $table->integer('lgacode')->nullable();
            $table->string('ward')->nullable();

            $table->string('occupation')->default('farmer');
            $table->text('experience')->nullable();
            $table->timestamps();

        });


        self::create([
            'user_id' => 1,
            'firstname' => 'Ande',
            'lastname' => 'Ordx',
            'mobile' => '08174570037',
            'lga_id' => 254,
            'gender' => 'male'
        ]);

        echo 'Profile Table Created/Seeded Successfully.... ';


    }
}
