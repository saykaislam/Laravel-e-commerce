<?php




//Frontend Site......................

Route::get('/','HomeController@index');

//Show product by category

Route::get('/product_by_category/{category_id}','HomeController@show_product_by_category');
Route::get('/product_by_manufacture/{manufacture_id}','HomeController@show_product_by_manufacture');
Route::get('/view_product/{product_id}','HomeController@product_details_by_id');

//ADD to Cart
Route::post('/add_to_cart','CartController@add_to_cart');
Route::get('/show_cart','CartController@show_cart');
Route::get('/delete_to_cart/{rowId}','CartController@delete_to_cart');
Route::post('/update_cart','CartController@update_cart');


//Checkout Routes
Route::get('/login_check','CheckoutController@login_check');
Route::post('/customer_registration','CheckoutController@customer_registration');
Route::get('/checkout','CheckoutController@checkout');
Route::post('/save_shipping_details','CheckoutController@save_shipping_details');

//customer login and logout 
Route::post('/customer_login','CheckoutController@customer_login');
Route::get('/customer_logout','CheckoutController@customer_logout');

Route::get('/payment','CheckoutController@payment');
Route::post('/order-place','CheckoutController@order_place');










//Backend Site....................
Route::get('/logout','SuperAdminController@logout');
Route::get('/admin','AdminController@index');
Route::get('/show_dashboard','SuperAdminController@show_dashboard');
Route::post('/admin_dashboard','AdminController@admin_dashboard');

// Category
Route::get('/addcategory','CategoryController@addcategory');
Route::get('/allcategory','CategoryController@allcategory');
Route::post('/save_category','CategoryController@save_category');
Route::get('/inactive_category/{category_id}','CategoryController@inactive_category');
Route::get('/active_category/{category_id}','CategoryController@active_category');
Route::get('/edit_category/{category_id}','CategoryController@edit_category');
Route::post('/update_category/{category_id}','CategoryController@update_category');
Route::get('/delete_category/{category_id}','CategoryController@delete_category');


//Manufacture
Route::get('/add_manufacture','ManufactureController@add_manufacture');
Route::post('/save_manufacture','ManufactureController@save_manufacture');
Route::get('/all_manufacture','ManufactureController@all_manufacture');
Route::get('/inactive_manufacture/{manufacture_id}','ManufactureController@inactive_manufacture');
Route::get('/active_manufacture/{manufacture_id}','ManufactureController@active_manufacture');
Route::get('/edit_manufacture/{manufacture_id}','ManufactureController@edit_manufacture');
Route::post('/update_manufacture/{manufacture_id}','ManufactureController@update_manufacture');
Route::get('/delete_manufacture/{manufacture_id}','ManufactureController@delete_manufacture');



//Products Route..........................
Route::get('/add_product','ProductController@add_product');
Route::post('/save_product','ProductController@save_product');
Route::get('/all_product','ProductController@all_product');
Route::get('/inactive_product/{product_id}','ProductController@inactive_product');
Route::get('/active_product/{product_id}','ProductController@active_product');
Route::get('/edit_product/{product_id}','ProductController@edit_product');
Route::post('/update_product/{product_id}','ProductController@update_product');
Route::get('/delete_product/{product_id}','ProductController@delete_product');


//Slider Route.......................................
Route::get('/add_slider','SliderController@add_slider');
Route::post('/save_slider','SliderController@save_slider');
Route::get('/all_slider','SliderController@all_slider');
Route::get('/inactive_slider/{slider_id}','SliderController@inactive_slider');
Route::get('/active_slider/{slider_id}','SliderController@active_slider');
Route::get('/delete_slider/{slider_id}','SliderController@delete_slider');

//Manage Order Route
Route::get('/manage_order','OrderController@manage_order');
Route::get('/view_order/{order_id}','OrderController@view_order');
Route::get('/inactive/{order_id}','OrderController@inactive_order');
Route::get('/active/{order_id}','OrderController@active_order');


