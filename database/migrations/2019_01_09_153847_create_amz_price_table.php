<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmzPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amz_price', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->index();
            $table->string('ASIN', 32);
            $table->string('CurrencyCode', 4);
            $table->double('LandedPrice')->default(0);
            $table->double('ListingPrice')->default(0);
            $table->double('Shipping')->default(0);
            $table->double('RegularPrice')->default(0);
            $table->string('FulfillmentChannel')->nullable();
            $table->string('ItemCondition')->nullable();
            $table->string('ItemSubCondition')->nullable();
            $table->string('SellerSKU')->nullable();
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
        Schema::dropIfExists('amz_price');
    }
}
