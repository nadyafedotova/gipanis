<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('count_sales', function (Blueprint $table) {
            $table->increments('tArtikel_kArtikel');
            $table->string('aType');
            $table->string('FulfillmentChannel');
            $table->string('ASIN');
            $table->string('pType');
            $table->string('interval');
            $table->json('count');
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
        Schema::dropIfExists('count_sales');
    }
}
