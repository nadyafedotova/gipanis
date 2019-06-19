<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmzReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amz_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->index();
            $table->string('asin');
            $table->string('ams_review_id');
            $table->string('star');
            $table->double('total');
            $table->string('comment');
            $table->string('date');
            $table->string('user');
            $table->string('user_url')->nullable();
            $table->string('order_id')->nullable();
            $table->string('order_url')->nullable();
            $table->text('title');
            $table->tinyInteger('sended')->default(0);
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
        Schema::dropIfExists('amz_reviews');
    }
}
