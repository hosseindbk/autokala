<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentrates', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('commentable_id');
            $table->string('commentable_type');
            $table->string('name');
            $table->string('phone');
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->boolean('approved')->default(0);

            $table->boolean('quality')->default(0);
            $table->boolean('value')->default(0);
            $table->boolean('innovation')->default(0);
            $table->boolean('ability')->default(0);
            $table->boolean('design')->default(0);
            $table->boolean('comfort')->default(0);
            $table->text('comment');
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
        Schema::dropIfExists('commentrates');
    }
}
