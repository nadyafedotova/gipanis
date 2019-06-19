<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->index();
            $table->date('date');
            $table->string('asin');
            $table->tinyInteger('venkon');
            $table->tinyInteger('notVenkon');
            $table->tinyInteger('venkonDe');
            $table->tinyInteger('venkonPrime');
            $table->tinyInteger('wd');
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
        Schema::dropIfExists('competitors');
    }
}
