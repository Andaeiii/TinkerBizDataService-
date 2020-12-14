<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class Category extends Basemodel{

	protected $table = 'categorys';
	protected $guarded = [];

    public $timestamps = false;

    public function valueChains(){
        return $this->hasMany('ValueChain', 'category_id');
    }

    public static function migrate(){
        Schema::dropIfExists('categorys');
        Schema::create('categorys', function (Blueprint $table){	
            $table->increments('id');
            $table->string('category');
            $table->string('measure');
            $table->string('scale');
            $table->text('description');
            $table->text('climate_factors');
            $table->text('other_info');
            $table->timestamps();
        });



        echo 'Category table / Seeding created successfully.....<br/>';
    }
}
