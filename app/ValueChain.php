<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class ValueChain extends Basemodel{

	protected $table = 'valuechains';
    protected $guarded = [];
    
    public $timestamps = false;

	public function Category(){
		return $this->belongsTo('App\Category', 'category_id');
	}

    public static function migrate(){
        Schema::dropIfExists('valuechains');
        Schema::create('valuechains', function (Blueprint $table){	

            $table->increments('id');
            $table->integer('category_id');
            $table->string('name');
            $table->text('description');
            //$table->timestamps();

        });

        echo 'ValueChains table / Seeding created successfully.....<br/>';
    }
}
