<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Schema\Blueprint;
use Schema;
use Validator;

class User extends Authenticatable{

    protected $table = 'users';
    protected $guarded = [];

    

    public static function validate($data){	
    
        $rules = [
            'usr_mail' => 'required|email', //|unique:users,email',
            'usr_pass' => 'required|min:6|alphaNum'
        ];

		$messages = [
			'required' => 'The :attribute field cannot be left blank',
			'email.unique'    => 'we need to know your email address',
			'password.same' => 'passwords do not match or are empty'
		];

		return Validator::make($data, $rules, $messages);

	}

    
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function farms(){
        return $this->hasMany('App\Farm', 'user_id');
    }

    public function transaction(){
        return $this->hasMany('App\Transaction', 'user_id');
    }

    public function profile(){
        return $this->hasOne('App\Profile', 'user_id');
    }


    public static function migrate(){
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table){
            $table->increments('id');
            $table->string('email');
            $table->string('password');
           // $table->string('auth_code');
            $table->datetime('last_visited')->default(date('Y-m-d h:i:s'));
            $table->string('type')->default('farmer');
            $table->string('remember_token')->nullable();
            $table->boolean('is_super_admin')->default(false);
            $table->timestamps();
        });

        //seed table....

        $u = new User;        
        $u->email             = 'andaeiii@aol.com';
        $u->password          = bcrypt('wyclef1234');
        $u->last_visited      = date('Y-m-d h:m:s');
        $u->type              = 'superadmin';
        $u->is_super_admin    = 1;
        $u->save();
              
        echo 'Users Table / Seeding  profile registered.....<br/>';
    }


}
