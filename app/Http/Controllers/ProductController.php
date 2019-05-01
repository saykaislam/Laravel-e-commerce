<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();


class ProductController extends Controller
{
    public function add_product() {
        $this->admin_auth_check();

    	return view('admin.add_product');
    }


    public function save_product(Request $request) {
        $this->admin_auth_check();

    	$data=array();
    	$data['product_name']=$request->product_name;
    	$data['category_id']=$request->category_id;
    	$data['manufacture_id']=$request->manufacture_id;
    	$data['product_short_description']=$request->product_short_description;
    	$data['product_long_description']=$request->product_long_description;
    	$data['product_price']=$request->product_price;
    	$data['product_size']=$request->product_size;
    	$data['product_color']=$request->product_color;
    	$data['publication_status']=$request->publication_status;

    	$image=$request->file('product_image');

    	if($image) {

    	   $image_name=str_random(20);
    		$ext=strtolower($image->getClientOriginalExtension());
    		$image_full_name=$image_name.'.'.$ext;
    		$upload_path='image/';
    		$image_url=$upload_path.$image_full_name;
    		$success=$image->move($upload_path,$image_full_name);

    	   if ($success) {
    			$data['product_image']=$image_url;

    			DB::table('tbl_products')->insert($data);
    			Session::put('message','Product Added Successfully!!');
    			return Redirect::to('/add_product');
    		}

    	}

    	$data['image']=$image_url;
    	DB::table('tbl_products')->insert($data);
    	Session::put('message','Product Added Successfully!!');
    			return Redirect::to('/add_product');

    	

    	//echo "<pre>";
    	//print_r($data);
    	//echo "</pre>";

    	DB::table('tbl_products')->insert($data);
    	Session::put('message', 'Product Added Successfully Without Image!!!');
    	return Redirect::to('/add_product');

    }



    public function all_product() {
        $this->admin_auth_check();

    		$all_product_info=DB::table('tbl_products')
    		    ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
    		    ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
    		    ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
    	        ->get();
    	$manage_product=view('admin.all_product')
    	        ->with('all_product_info',$all_product_info);
    	return view('admin_layout')
    	        ->with('admin.all_product',$manage_product);

    }

      public function inactive_product($product_id) {
        $this->admin_auth_check();

        DB::table('tbl_products')
            ->where('product_id',$product_id)
            ->update(['publication_status' =>0 ]);
        Session::put('message', 'Product Inactivated Successfully!!!');
        return Redirect::to('/all_product');

    }

    public function active_product($product_id) {
        $this->admin_auth_check();

        DB::table('tbl_products')
            ->where('product_id',$product_id)
            ->update(['publication_status' =>1 ]);
        Session::put('message', 'Product Activated Successfully!!!');
        return Redirect::to('/all_product');

    }

    public function delete_product($product_id) {
        $this->admin_auth_check();

    	
        DB::table('tbl_products')
            ->where('product_id',$product_id)
            ->delete();
        Session::put('message', 'Product Deleted Successfully!!!');
        return Redirect::to('/all_product');
    }

    

    public function edit_product($product_id) {

        $edit_product_info=DB::table('tbl_products')
            ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
            ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
            ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
            ->where('product_id',$product_id)
            
            ->first();

        $manage_product_info=view('admin.edit_product')
                ->with('edit_product_info',$edit_product_info);
        return view('admin_layout')
                ->with('admin.edit_product',$manage_product_info);
       

       //return view('admin.edit_category');
        
    }
     public function update_product(Request $request, $product_id) {
        

        $data=array();
        $data['product_name']=$request->product_name;
        $data['category_id']=$request->category_id;
        $data['manufacture_id']=$request->manufacture_id;
        $data['product_short_description']=$request->product_short_description;
        $data['product_long_description']=$request->product_long_description;
        $data['product_price']=$request->product_price;
        $data['product_size']=$request->product_size;
        $data['product_color']=$request->product_color;
       

        $image=$request->file('product_image');

        if($image) {

           $image_name=str_random(20);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);

           if ($success) {
                $data['product_image']=$image_url;

                DB::table('tbl_products')
                ->where('product_id', $product_id)
                ->Update($data);
                Session::put('message','Product Added Successfully!!');
                return Redirect::to('/all_product');
            }

        }

        $data['image']=$image_url;
        DB::table('tbl_products')
               ->where('product_id', $product_id)
               ->Update($data);
        Session::put('message','Product Added Successfully!!');
                return Redirect::to('/all_product');

        

        //echo "<pre>";
        //print_r($data);
        //echo "</pre>";

        DB::table('tbl_products')
          ->where('product_id', $product_id)
          ->Update($data);
        Session::put('message', 'Product Added Successfully Without Image!!!');
        return Redirect::to('/all_product');

           

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
