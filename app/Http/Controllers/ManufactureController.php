<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class ManufactureController extends Controller
{
    public function add_manufacture() {
          $this->admin_auth_check();


      return view('admin.add_manufacture');
    }

    public function save_manufacture(Request $request) {
          $this->admin_auth_check();


        $data=array();
    	$data['manufacture_id']=$request->manufacture_id;
    	$data['manufacture_name']=$request->manufacture_name;
    	$data['manufacture_description']=$request->manufacture_description;
    	$data['publication_status']=$request->publication_status;

    	//echo "<pre>";
    	//print_r($data);
    	//echo "</pre>";

    	DB::table('tbl_manufacture')->insert($data);
    	Session::put('message', 'Manufacture Added Successfully!!!');
    	return Redirect::to('/add_manufacture');
    }


     public function all_manufacture() {
          $this->admin_auth_check();


    		$all_manufacture_info=DB::table('tbl_manufacture')
    	        ->get();
    	$manage_manufacture=view('admin.all_manufacture')
    	        ->with('all_manufacture_info',$all_manufacture_info);
    	return view('admin_layout')
    	        ->with('admin.all_manufacture',$manage_manufacture);
    }


    public function inactive_manufacture($manufacture_id) {

        DB::table('tbl_manufacture')
            ->where('manufacture_id',$manufacture_id)
            ->update(['publication_status' =>0 ]);
        Session::put('message', 'Manufacture Inactivated Successfully!!!');
        return Redirect::to('/all_manufacture');

    }


    public function active_manufacture($manufacture_id) {

        DB::table('tbl_manufacture')
            ->where('manufacture_id',$manufacture_id)
            ->update(['publication_status' =>1 ]);
        Session::put('message', 'Manufacture Activated Successfully!!!');
        return Redirect::to('/all_manufacture');

    }


       public function edit_manufacture($manufacture_id) {

        $edit_manufacture_info=DB::table('tbl_manufacture')
            ->where('manufacture_id',$manufacture_id)
            ->first();

        $manage_manufacture_info=view('admin.edit_manufacture')
    	        ->with('edit_manufacture_info',$edit_manufacture_info);
    	return view('admin_layout')
    	        ->with('admin.edit_manufacture',$manage_manufacture_info);
       
    	
    }


     public function update_manufacture(Request $request,$manufacture_id) {
       
      
    	$data=array();
    	$data['manufacture_name']=$request->manufacture_name;
    	$data['manufacture_description']=$request->manufacture_description;
  

    	

    	DB::table('tbl_manufacture')
    	    ->where('manufacture_id',$manufacture_id)
    	    ->update($data);
    	Session::put('message', 'Manufacture Updated Successfully!!!');
    	return Redirect::to('/all_manufacture');
    	
    }


     public function delete_manufacture($manufacture_id) {

    	
        DB::table('tbl_manufacture')
            ->where('manufacture_id',$manufacture_id)
            ->delete();
        Session::put('message', 'Manufacture Deleted Successfully!!!');
        return Redirect::to('/all_manufacture');
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
