<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('cart_id')->unsigned();
            // $table->foreign('cart_id')->references('id')->on('products')->onDelete('cascade');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // $table->integer('count')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->integer('post_code');
            $table->bigInteger('phone')->nullable();

            // $table->integer('price');

            // $table->float('total');

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
        Schema::dropIfExists('purchases');
    }
}
