<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmzFbaHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amz_fba_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id')->index();
            $table->integer('store_id')->index();
            $table->string('sku', 32);
            $table->string('fnsku', 32);
            $table->string('asin', 32);
            $table->string('product_name')->nullable();
            $table->string('condition')->nullable();
            $table->double('your_price')->nullable();
            $table->string('mfn_listing_exists')->nullable();
            $table->string('mfn_fulfillable_quantity')->nullable();
            $table->string('afn_listing_exists')->nullable();
            $table->integer('afn_warehouse_quantity')->default(0);
            $table->integer('afn_fulfillable_quantity')->default(0);
            $table->integer('afn_unsellable_quantity')->default(0);
            $table->integer('afn_reserved_quantity')->default(0);
            $table->integer('afn_total_quantity')->default(0);
            $table->double('per_unit_volume')->default(0);
            $table->integer('afn_inbound_working_quantity')->default(0);
            $table->integer('afn_inbound_shipped_quantity')->default(0);
            $table->integer('afn_inbound_receiving_quantity')->default(0);
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
        Schema::dropIfExists('amz_fba_history');
    }
}
