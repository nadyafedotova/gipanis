<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmzRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amz_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id');
            $table->string('asin', 32);
            $table->double('rating');
            $table->integer('stars1');
            $table->integer('stars2');
            $table->integer('stars3');
            $table->integer('stars4');
            $table->integer('stars5');
            $table->text('title');
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
        Schema::dropIfExists('amz_ratings');
    }
}
