<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmzFbaConvergedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amz_fba_converged', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->index();
            $table->string('item_name')->nullable();
            $table->string('listing_id')->nullable();
            $table->string('sku', 32)->nullable();
            $table->double('price')->nullable();
            $table->integer('shipping_fee')->nullable();
            $table->timestamp('purchase_date')->nullable();
            $table->string('buyer_email')->nullable();
            $table->string('buyer_nick_name')->nullable();
            $table->double('date_listed')->nullable();
            $table->string('item_is_marketplace')->nullable();
            $table->integer('quantity')->default(0);
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
        Schema::dropIfExists('amz_fba_converged');
    }
}
