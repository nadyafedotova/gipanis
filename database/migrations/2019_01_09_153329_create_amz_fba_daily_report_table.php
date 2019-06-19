<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmzFbaDailyReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amz_fba_daily_report', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->index();
            $table->timestamp('snapshot_date')->nullable();
            $table->string('fnsku', 32);
            $table->string('sku', 32 );
            $table->text('product_name')->nullable();
            $table->integer('quantity')->default(0);
            $table->string('fulfillment_center_id')->nullable();
            $table->string('detailed_disposition')->nullable();
            $table->string('country')->nullable();
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
        Schema::dropIfExists('amz_fba_daily_report');
    }
}
