<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJtlTWarenLagerEingangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jtl_tWarenLagerEingang', function (Blueprint $table) {
            $table->increments('kWarenLagerEingang');
            $table->integer('kArtikel');
            $table->integer('kWarenLagerPlatz');
            $table->integer('kLieferantenBestellungPos')->nullable();
            $table->integer('kBenutzer');
            $table->double('fAnzahl');
            $table->double('fEKEinzel');
            $table->string('cLieferscheinNr')->nullable();
            $table->string('cChargenNr')->nullable();
            $table->dateTime('dMHD')->nullable();
            $table->dateTime('dErstellt')->nullable();
            $table->dateTime('dGeliefertAM')->nullable();
            $table->string('cKommentar')->nullable();
            $table->integer('kGutschriftPos')->nullable();
            $table->integer('kWarenLagerAusgang')->nullable();
            $table->integer('kLHM')->nullable();
            $table->double('fAnzahlAktuell');
            $table->double('fAnzahlReserviertPickpos');
            $table->integer('kSessionID')->nullable();
            $table->integer('kWarenLagerEingang_Ursprung')->nullable();
            $table->integer('kBuchungsart');
            $table->integer('kBestellPosUmlagerung')->nullable();
            $table->integer('kRMRetourePos')->nullable();
            $table->tinyInteger('nGLDBerechnungMitEingangsrechnung');
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
        Schema::dropIfExists('jtl_tWarenLagerEingang');
    }
}
