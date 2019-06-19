<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmzDetailedSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amz_detailed_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->index();
            $table->date('date')->nullable();
            $table->string('parentAsin', 50)->nullable();
            $table->string('childAsin', 50)->nullable();
            $table->string('title')->nullable();
            $table->integer('sessions')->nullable();
            $table->double('sessionsPercentage')->nullable();
            $table->integer('pageViews')->nullable();
            $table->double('pageViewsPercentage')->nullable();
            $table->double('buyBoxPercentage')->nullable();
            $table->integer('unitsOrdered')->nullable();
            $table->double('unitsSessionPercentage')->nullable();
            $table->string('orderedProductSales')->nullable();
            $table->integer('totalOrderedItems')->nullable();
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
        Schema::dropIfExists('amz_detailed_sales');
    }
}
