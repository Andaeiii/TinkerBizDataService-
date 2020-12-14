<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\User;
use App\Profile;
use App\Payment;
use App\Inmail;
use App\Prayer;
use App\Log;
use App\Reading;

use DB;

class UserController extends Controller{
    
	public function processlogin(Request $request){

		//pr($request->all(), true);

		$v = User::validate($request->all());

		if($v->passes()){

			$ar = [
				'email' => $request->input('usr_mail'),
				'password' => $request->input('usr_pass')
			];

			if(Auth::attempt($ar)){
				switch(Auth::user()->type){
				case 'admin':
				case 'superadmin':
					return redirect()->to('/dashboard');
					break;
				default:
					return redirect()->to('/logout');
					break;
				}
			}else{
				pr($v->errors());
				//return redirect()->back()->with('error','Un-warranted Access......');
			}
				
		}else{

			pr($v->errors());

		}
	}


	public function makeAdmin($id){
		
		DB::transaction(function()use($id){
			$cid = User::find($id)->church_id;
			//update old admin...
			$a = User::where('church_id', $cid)->where('type', 'admin')->first(); //->update(['type'=>'member']);
			$a->type = 'member';
			$a->save();
			//update new admin..
			$u = User::find($id);
			$u->type = 'admin';
			$u->save(); //->update(['type'=>'admin']);
		});

		return redirect()->back()->with('success', 'Admin, changed successfully....');
		
	}


	public function logout(){
		Auth::logout();
		return redirect()->to('/')->with('message', 'See you next time... ');
	}

	public function updateProfile(Request $request){
		//pr($request->all(), true);
		DB::transaction(function()use($request){
			$u = User::find($request->input('uid'));
			$u->email = $request->input('email');
			$u->password = bcrypt($request->input('password'));
			$u->save();

			$p = Profile::where('user_id', $request->input('uid'))->first();
			$p->fullname = $request->input('fullname');
			$p->birthday = $request->input('birthday');
			$p->phone = $request->input('mobile');
			$p->skills = trim(ucwords(strtolower($request->input('skills'))));
			$p->save();
		});

		return redirect()->back()->with('success', 'Profile Updated Successfully..');
	}

	public function deleteUser($id){
		$u = User::find($id);
		DB::beginTransaction();
		try{
			Profile::where('user_id', $u->id)->delete();
			Payment::with('transactions')->where('user_id', $u->id)->delete();
			Inmail::where('user_id', $u->id)->delete();
			Prayer::where('user_id', $u->id)->delete();
			Log::where('user_id', $u->id)->delete();
			Reading::where('user_id', $u->id)->update(['user_id'=>1]);
			$u->delete();
			DB::commit();
				return redirect()->back()->with('success', '...user deleted successfully');
		}catch(Exception $e){
			DB::rollback();
				return redirect()->back()->with('error', '...error deleting user');
		}

	}

}
