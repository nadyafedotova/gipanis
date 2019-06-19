<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmzFbaMerchantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amz_fba_merchant', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->index();
            $table->string('item_name')->nullable();
            $table->text('item_description')->nullable();
            $table->string('listing_id')->nullable();
            $table->string('seller_sku', 32)->nullable();
            $table->double('price')->default(0);
            $table->integer('quantity')->default(0);
            $table->timestamp('open_date')->nullable();
            $table->string('image_url')->nullable();
            $table->string('item_is_marketplace')->nullable();
            $table->integer('product_id_type')->nullable();
            $table->string('zshop_shipping_fee')->nullable();
            $table->string('item_note')->nullable();
            $table->integer('item_condition')->nullable();
            $table->string('zshop_category1')->nullable();
            $table->string('zshop_browse_path')->nullable();
            $table->string('zshop_storefront_feature')->nullable();
            $table->string('asin1', 32)->nullable();
            $table->string('asin2', 32)->nullable();
            $table->string('asin3', 32)->nullable();
            $table->string('will_ship_internationally')->nullable();
            $table->string('expedited_shipping')->nullable();
            $table->string('zshop_boldface')->nullable();
            $table->string('product_id')->nullable();
            $table->string('bid_for_featured_placement')->nullable();
            $table->string('add_delete')->nullable();
            $table->string('pending_quantity')->nullable();
            $table->string('fulfillment_channel', 32)->nullable();
            $table->string('merchant_shipping_group')->nullable();
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
        Schema::dropIfExists('amz_fba_merchant');
    }
}
