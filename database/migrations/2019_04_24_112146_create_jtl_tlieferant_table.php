<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJtlTlieferantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jtl_tlieferant', function (Blueprint $table) {
            $table->integer('kLieferant');
            $table->string('cLiefNr', 64)->nullable();
            $table->string('cFirma')->nullable();
            $table->string('cKontakt')->nullable();
            $table->string('cStrasse')->nullable();
            $table->string('cPLZ', 10)->nullable();
            $table->string('cOrt')->nullable();
            $table->string('cLand')->nullable();
            $table->string('cTelZentralle', 30)->nullable();
            $table->string('cTelDurchwahl', 30)->nullable();
            $table->string('cFax', 30)->nullable();
            $table->string('cEMail')->nullable();
            $table->string('cWWW')->nullable();
            $table->string('cAnmerkung', 5000)->nullable();
            $table->dateTime('dErstellt')->nullable();
            $table->char('cAktiv')->nullable();
            $table->string('cUstid', 30)->nullable();
            $table->string('cISO', 5);
            $table->integer('kSprache')->nullable();
            $table->string('cStatus')->nullable();
            $table->string('cLieferantID', 64)->nullable();
            $table->integer('nKreditorennr')->nullable();
            $table->string('cWaehrungISO', 20)->nullable();
            $table->tinyInteger('nVSTFrei')->nullable();
            $table->string('cExterneDatenUrl')->nullable();
            $table->tinyInteger('nDropshipping')->nullable();
            $table->integer('nLieferzeit')->nullable();
            $table->integer('nZahlungsziel')->nullable();
            $table->double('fSkonto');
            $table->double('fMindestbestellwert');
            $table->double('fMindermengenzuschlag');
            $table->double('fFrachtkosten');
            $table->double('fVersandfreiAb');
            $table->string('cHinweisLieferbedingung', 1000)->nullable();
            $table->string('cFirmenZusatz')->nullable();
            $table->string('cAdresszusatz')->nullable();
            $table->string('cBundesland')->nullable();
            $table->integer('nSkontoTage')->nullable();
            $table->tinyInteger('nStaffelPreisProBestellung')->nullable();
            $table->tinyInteger('nKeineEinkaufsliste')->nullable();
            $table->string('cVorname', 126)->nullable();
            $table->string('cNachname', 126)->nullable();
            $table->tinyInteger('nDropshippingBeiNachnahme');
            $table->integer('nStandardFirma');
            $table->integer('nStandardLager');
            $table->double('fMwStFreiposition');
            $table->tinyInteger('nDropshippingFreipositionen');
            $table->tinyInteger('nJtlFulfillment')->nullable();
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
        Schema::dropIfExists('jtl_tlieferant');
    }
}
