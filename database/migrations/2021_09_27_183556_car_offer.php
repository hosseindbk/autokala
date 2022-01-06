<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CarOffer extends Migration
{

    public function up()
    {
        Schema::create('car_offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_brand_id');
            $table->foreign('car_brand_id')->references('id')->on('car_brands')->onDelete('cascade');
            $table->unsignedBigInteger('car_model_id');
            $table->foreign('car_model_id')->references('id')->on('car_models')->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('car_offers');
    }
}
