<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_products', function (Blueprint $table) {
            $table->bigIncrements('product_id');
            $table->String('product_name');
            $table->integer('category_id');
            $table->integer('manufacture_id');
            $table->LongText('product_short_description');
            $table->LongText('product_long_description');
            $table->float('product_price');
            $table->String('product_image');
            $table->String('product_size');
            $table->String('product_color');
            $table->integer('publication_status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_products');
    }
}
