<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJtlLagerbestandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jtl_lagerbestand', function (Blueprint $table) {
            $table->increments('kArtikel');
            $table->integer('fLagerbestand');
            $table->integer('fVerfuegbar');
            $table->integer('fVerfuegbarGesperrt');
            $table->integer('fZulauf');
            $table->integer('fAufEinkaufsliste');
            $table->dateTime('dLieferdatum')->nullable();
            $table->integer('fLagerbestandEigen');
            $table->integer('fInAuftraegen');
            $table->tinyInteger('nLagerAktiv');
            $table->tinyInteger('nArtikelTyp');
            $table->tinyInteger('nTeilbar');
            $table->tinyInteger('nLagerKleinerNull');
            $table->double('fAuslieferungGesperrt');
            $table->binary('bRowversion');
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
        Schema::dropIfExists('jtl_lagerbestand');
    }
}
