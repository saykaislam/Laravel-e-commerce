<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class SuperAdminController extends Controller
{

	 public function show_dashboard() {
	 	
	 	$this->admin_auth_check();
    	return view('admin.dashboard');
    }

      public function logout() {
    	//Session::put('admin_name',null);
    	//Session::put('admin_id',null);
    	Session::flush();
    	return Redirect::to('/admin');
    }

     public function admin_auth_check() {
    	$admin_id=Session::get('admin_id');
    	if ($admin_id) {
    		return;
    	}
    	else {
    		return Redirect::to('/admin')->send();
    	}
    }


}
