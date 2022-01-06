<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Productbrandvariety extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productbrandvarietes', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->string('image');
            $table->text('description');
            $table->tinyInteger('status');
            $table->string('item1');
            $table->string('value_item1');
            $table->string('item2');
            $table->string('value_item2');
            $table->string('item3');
            $table->string('value_item3');
            $table->string('date');
            $table->bigInteger('user_id');
            $table->string('guarantee');
            $table->string('user_handle');
            $table->string('date_handle');
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
        Schema::dropIfExists('productbrandvarietes');
    }
}
