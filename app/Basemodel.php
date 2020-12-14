<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Validator;

class Basemodel extends Model{

	
	//validate data based on rules from ref-model...
	public static function validate($data){		

		$messages = [
			'required' => 'The :attribute field cannot be left blank',
			'email_addr.unique'    => 'we need to know your email address',
			'password.same' => 'passwords do not match or are empty'
		];

		return Validator::make($data, static::$rules, $messages);

	}

	
}
