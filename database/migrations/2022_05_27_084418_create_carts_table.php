<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{

    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('product_id')->unsigned();
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->integer('price');
            $table->integer('quantity');
            $table->integer('total');
            // $table->float('productprice')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
