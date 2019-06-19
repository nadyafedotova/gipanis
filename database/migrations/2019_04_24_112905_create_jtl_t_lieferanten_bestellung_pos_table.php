<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJtlTLieferantenBestellungPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jtl_tLieferantenBestellungPos', function (Blueprint $table) {
            $table->increments('kLieferantenBestellungPos');
            $table->integer('kLieferantenBestellung');
            $table->integer('kArtikel');
            $table->string('cArtNr')->nullable();
            $table->string('cLieferantenArtNr')->nullable();
            $table->string('cName')->nullable();
            $table->string('cLieferantenBezeichnung')->nullable();
            $table->double('fUST');
            $table->double('fMenge');
            $table->string('cHinweis')->nullable();
            $table->double('fEKNetto');
            $table->integer('nPosTyp')->nullable();
            $table->string('cNameLieferant')->nullable();
            $table->integer('nLiefertage')->nullable();
            $table->dateTime('dLieferdatum')->nullable();
            $table->integer('nSort');
            $table->integer('kLieferscheinPos');
            $table->string('cVPEEinheit')->nullable();
            $table->string('nVPEMenge')->nullable();
            $table->double('fMengeGeliefert');
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
        Schema::dropIfExists('jtl_tLieferantenBestellungPos');
    }
}
