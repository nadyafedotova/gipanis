<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmzFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amz_fees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->index();
            $table->string('asin')->nullable();
            $table->string('marketplace_id')->nullable();
            $table->double('amount')->default(0);
            $table->string('currency_code',4)->nullable();
            $table->double('shipping_amount')->default(0);
            $table->string('shipping_currency_code', 4)->nullable();
            $table->timestamp('time_of_fees_estimation')->nullable();
            $table->double('total_fees_estimate')->default(0);
            $table->string('tfe_currency_code')->nullable();
            $table->double('referral_fee')->default(0);
            $table->double('variable_closing_fee')->default(0);
            $table->double('per_item_fee')->default(0);
            $table->double('FBA_fees')->default(0);
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
        Schema::dropIfExists('amz_fees');
    }
}
