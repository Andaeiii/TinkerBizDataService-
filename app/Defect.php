<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class Defect extends Basemodel{

	protected $table = 'defects';
    protected $guarded = [];
    
    public $timestamps = false;

    //no relationships.... 
    public static function migrate(){
        Schema::dropIfExists('defects');
        Schema::create('defects', function (Blueprint $table){	
            $table->increments('id');
            $table->string('name');
            $table->text('environment');
            $table->text('references');  //serialzied references of defects... links particularly.
            $table->text('control_measure');
            $table->string('defect_type_ids'); // serialized ids of defect types....  pointing to defect tables... 
        });

        echo 'Defects table / Seeding created successfully.....<br/>';
    }
}
