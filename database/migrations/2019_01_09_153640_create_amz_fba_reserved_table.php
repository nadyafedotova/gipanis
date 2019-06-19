<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmzFbaReservedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amz_fba_reserved', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->index();
            $table->string('sku', 32);
            $table->string('fnsku', 32);
            $table->string('asin', 32);
            $table->string('product_name');
            $table->integer('reserved_qty')->default(0);
            $table->integer('reserved_customerorders')->default(0);
            $table->integer('reserved_fc_transfers')->default(0);
            $table->integer('reserved_fc_processing')->default(0);
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
        Schema::dropIfExists('amz_fba_reserved');
    }
}
