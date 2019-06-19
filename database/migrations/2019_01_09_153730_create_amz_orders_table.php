<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmzOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amz_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('AmazonOrderId')->unique();
            $table->string('SellerOrderId');
            $table->string('PurchaseDate')->index();
            $table->string('LastUpdateDate')->index();
            $table->string('OrderStatus')->nullable()->index();
            $table->string('FulfillmentChannel')->nullable()->index();
            $table->string('SalesChannel')->index();
            $table->string('ShipServiceLevel');
            $table->string('CurrencyCode', 4);
            $table->double('Amount')->default(0);
            $table->integer('NumberOfItemsShipped')->default(0);
            $table->integer('NumberOfItemsUnshipped')->default(0);
            $table->string('ShippingAddressName')->nullable();
            $table->string('ShippingAddressAddressLine2')->nullable();
            $table->string('ShippingAddressCity')->nullable();
            $table->string('ShippingAddressPostalCode')->nullable();
            $table->string('ShippingAddressCountryCode')->nullable();
            $table->string('ShippingAddressPhone')->nullable();
            $table->string('MarketplaceId')->nullable();
            $table->string('BuyerEmail')->nullable();
            $table->string('BuyerName')->nullable();
            $table->string('ShipmentServiceLevelCategory')->nullable();
            $table->string('OrderType')->nullable();
            $table->tinyInteger('IsPrime')->nullable();
            $table->tinyInteger('IsPremiumOrder')->nullable();
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
        Schema::dropIfExists('amz_orders');
    }
}
