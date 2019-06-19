<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJtlLagerplatzReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jtl_lagerplatz_report', function (Blueprint $table) {
            $table->increments('kWarenLagerPlatz');
            $table->integer('kWarenLager');
            $table->double('fGewichtMax');
            $table->mediumText('cKommentar')->nullable();
            $table->double('fLaenge');
            $table->double('fBreite');
            $table->double('fHoehe');
            $table->integer('nSort')->nullable();
            $table->string('cName')->nullable();
            $table->integer('kWarenLagerPlatzTyp')->nullable();
            $table->integer('nStatus');
            $table->dateTime('dWmsInventurDatum')->nullable();
            $table->integer('kWmsInventur');
            $table->integer('nPreInvStatus');
            $table->tinyInteger('nInvGezaehlt');
            $table->tinyInteger('nGesperrt');
            $table->integer('nPrio');
            $table->tinyInteger('nAuslieferungGesperrt');
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
        Schema::dropIfExists('jtl_lagerplatz_report');
    }
}
