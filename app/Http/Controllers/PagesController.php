<?php

namespace App\Http\Controllers;

use Auth;
use App\User;

use Illuminate\Http\Request;

class PagesController extends Controller{
   
     public function index(){
          if(Auth::check()){
               return view('pages.index');
          }else{
               return redirect()->to('login');
          }   
          //->with('user', User::with('profile')->find(Auth::id()))
          // ->with('pgtitle', 'Manage Profile');
     }

     public function login(){
          return view('pages.login');
     }

     public function dashboard(){
          $user = Auth::user()->load('profile');
          return view('pages.index')
                    ->with('user', $user)
                    ->with('pg_title', 'Dashboard')
                    ->with('pg_desc','The most complete user interface framework that');
     }

     public function logout(){
          Auth::logout();
          return redirect()->to('login');
     }


}
