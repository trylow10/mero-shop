<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            // $table->foreignId('category_id');
            $table->string('name');
            $table->string('description');
            // $table->string('title');
            $table->string('price')->nullable();
            $table->string('image');
            $table->float('discount')->nullable();
            $table->integer('stocks')->nullable();
            // $table->float('productprice')->nullable();
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
        Schema::dropIfExists('products');
    }
}
