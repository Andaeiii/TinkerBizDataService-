<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class Transaction extends Basemodel{

	protected $table = 'transactions';
	protected $guarded = [];

	public function user(){
		return $this->belongsTo('App\User', 'user_id');
	}

    public function business(){
        return $this->belongsTo('App\Business', 'business_id');
    }

    public static function migrate(){
        Schema::dropIfExists('transactions');
        Schema::create('transactions', function (Blueprint $table){	

            $table->increments('id');
            $table->integer('user_id');
            $table->integer('business_id');

            $table->string('BVN');
            $table->string('loan');

            $table->datetime('loan_date');
            $table->string('amount');
            $table->string('year');
            $table->boolean('is_paid');

            $table->string('balance');
            $table->string('ins_policy');

            $table->text('remarks');
            $table->timestamps();
            
        });


        echo 'Transactions table / Seeding created successfully.....<br/>';
    }
}
