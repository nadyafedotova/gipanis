<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmzOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amz_order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('AmazonOrderId');
            $table->string('ASIN');
            $table->string('SellerSKU')->index();
            $table->string('OrderItemId')->unique();
            $table->text('Title');
            $table->integer('QuantityOrdered')->default(0);
            $table->integer('QuantityShipped')->default(0);
            $table->string('ItemPriceCurrencyCode', 4)->nullable();
            $table->double('ItemPriceAmount')->default(0);
            $table->string('ShippingPriceCurrencyCode')->nullable();
            $table->double('ShippingPriceAmount')->default(0);
            $table->string('GiftWrapPriceCurrencyCode',4);
            $table->double('GiftWrapPriceAmount')->default(0);
            $table->string('PromotionIds')->nullable();
            $table->string('ConditionId')->nullable();
            $table->string('PromotionDiscountAmount')->index()->default(0);
            $table->string('PromotionDiscountCurrencyCode')->nullable();
            $table->json('BuyerCustomizedInfo')->nullable();
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
        Schema::dropIfExists('amz_order_items');
    }
}
