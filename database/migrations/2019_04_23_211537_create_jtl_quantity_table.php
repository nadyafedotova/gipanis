<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJtlQuantityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jtl_quantity', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kArtikel')->unique();
            $table->integer('fLagerbestand');
            $table->integer('fVerfuegbar');
            $table->integer('fReserviert');
            $table->integer('fVerfuegbarGesperrt');
            $table->integer('fZulauf');
            $table->integer('fZulaufVerfuegbar');
            $table->integer('fAufEinkaufsliste');
            $table->dateTime('dLieferdatum')->nullable();
            $table->integer('fEigenerBestand');
            $table->integer('fVerfuegbarExtern');
            $table->integer('fInAuftraegen');
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
        Schema::dropIfExists('jtl_quantity');
    }
}
