<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class SliderController extends Controller
{
    public function add_slider() {
    	return view('admin.add_slider');
    }

    public function save_slider(Request $request) {

    	$data=array();
    	$data['publication_status']=$request->publication_status;

    	$image=$request->file('slider_image');

    	if($image) {

    	   $image_name=str_random(20);
    		$ext=strtolower($image->getClientOriginalExtension());
    		$image_full_name=$image_name.'.'.$ext;
    		$upload_path='image/';
    		$image_url=$upload_path.$image_full_name;
    		$success=$image->move($upload_path,$image_full_name);

    	   if ($success) {
    			$data['slider_image']=$image_url;

    			DB::table('tbl_slider')->insert($data);
    			Session::put('message','Slider Added Successfully!!');
    			return Redirect::to('/add_slider');
    		}

    	}

    	$data['image']=$image_url;
    	DB::table('tbl_slider')->insert($data);
    	Session::put('message','Slider Added Successfully!!');
    			return Redirect::to('/add_slider');

    	

    	// echo "<pre>";
    	// print_r($data);
    	// echo "</pre>";

    	DB::table('tbl_slider')->insert($data);
    	Session::put('message', 'Slider Added Successfully Without Image!!!');
    	return Redirect::to('/add_slider');

    }

      public function all_slider() {
    	 $this->admin_auth_check();

    		$all_slider_info=DB::table('tbl_slider')
    		    ->select('*')
    	        ->get();
    	$manage_slider=view('admin.all_slider')
    	        ->with('all_slider_info',$all_slider_info);
    	return view('admin_layout')
    	        ->with('admin.all_slider',$manage_slider);


    }

     public function inactive_slider($slider_id) {

        DB::table('tbl_slider')
            ->where('slider_id',$slider_id)
            ->update(['publication_status' =>0 ]);
        Session::put('message', 'Slider Inactivated Successfully!!!');
        return Redirect::to('/all_slider');

    }

     public function active_slider($slider_id) {

        DB::table('tbl_slider')
            ->where('slider_id',$slider_id)
            ->update(['publication_status' =>1 ]);
        Session::put('message', 'Slider Activated Successfully!!!');
        return Redirect::to('/all_slider');

    }

     public function delete_slider($slider_id) {

    	
        DB::table('tbl_slider')
            ->where('slider_id',$slider_id)
            ->delete();
        Session::put('message', 'Slider Deleted Successfully!!!');
        return Redirect::to('/all_slider');
    }







     
    //Admin Auth Cheacking
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
