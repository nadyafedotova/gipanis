<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJtlWarenlagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jtl_warenlager', function (Blueprint $table) {
            $table->increments('kWarenLager');
            $table->string('cName')->nullable();
            $table->string('cKuerzel')->nullable();
            $table->string('cLagerTyp')->nullable();
            $table->string('cBeschreibung')->nullable();
            $table->string('cStrasse')->nullable();
            $table->string('cPLZ')->nullable();
            $table->string('cOrt')->nullable();
            $table->string('cLand')->nullable();
            $table->string('cAnsprechpartnerAnrede')->nullable();
            $table->string('cAnsprechpartnerVorname')->nullable();
            $table->string('cAnsprechpartnerName')->nullable();
            $table->string('cAnsprechpartnerTel')->nullable();
            $table->string('cAnsprechpartnerFax')->nullable();
            $table->string('cAnsprechpartnerEMail')->nullable();
            $table->string('cAnsprechpartnerAbteilung')->nullable();
            $table->string('cBundesland', 100)->nullable();
            $table->integer('kFirma')->nullable();
            $table->integer('kUser')->nullable();
            $table->tinyInteger('nFulfillment');
            $table->tinyInteger('nLagerplatzVerwaltung');
            $table->integer('nAuslieferungsPrio')->nullable();
            $table->tinyInteger('nPackStationAktiv')->nullable();
            $table->string('cDimension1Name')->nullable();
            $table->string('cDimension1Trennzeichen', 1)->nullable();
            $table->tinyInteger('nDimension1Laenge')->nullable();
            $table->tinyInteger('nDimension1Typ')->nullable();
            $table->string('cDimension2Name')->nullable();
            $table->string('cDimension2Trennzeichen')->nullable();
            $table->tinyInteger('nDimension2Laenge')->nullable();
            $table->tinyInteger('nDimension2Typ')->nullable();
            $table->string('cDimension3Name')->nullable();
            $table->string('cDimension3Trennzeichen', 1)->nullable();
            $table->tinyInteger('nDimension3Laenge')->nullable();
            $table->tinyInteger('nDimension3Typ')->nullable();
            $table->string('cDimension4Name')->nullable();
            $table->string('cDimension4Trennzeichen', 1)->nullable();
            $table->tinyInteger('nDimension4Laenge')->nullable();
            $table->tinyInteger('nDimension4Typ')->nullable();
            $table->string('cDimension5Name')->nullable();
            $table->string('cDimension5Trennzeichen', 1)->nullable();
            $table->tinyInteger('nDimension5Laenge')->nullable();
            $table->tinyInteger('nDimension5Typ')->nullable();
            $table->string('cEmpfaengerFirma')->nullable();
            $table->integer('kQuellLager');
            $table->integer('kZielLager');
            $table->tinyInteger('nAktiv');
            $table->string('cJfwid', 50)->nullable();
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
        Schema::dropIfExists('jtl_warenlager');
    }
}
