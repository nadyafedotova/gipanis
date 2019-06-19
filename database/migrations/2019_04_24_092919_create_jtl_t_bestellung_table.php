<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJtlTBestellungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jtl_tBestellung', function (Blueprint $table) {
            $table->increments('kBestellung');
            $table->integer('tRechnung_kRechnung')->nullable();
            $table->integer('tBestellung_kBestellung');
            $table->integer('tAdresse_kAdresse')->nullable();
            $table->integer('tText_kText');
            $table->integer('tKunde_kKunde');
            $table->string('cBestellNr', 50)->nullable();
            $table->char('cType', 1)->nullable();
            $table->string('cAnmerkung', 4500)->nullable();
            $table->dateTime('dErstellt')->nullable();
            $table->tinyInteger('nZahlungsziel');
            $table->integer('tVersandArt_kVersandArt');
            $table->double('fVersandBruttoPreis');
            $table->double('fRabatt');
            $table->integer('kInetBestellung')->nullable();
            $table->string('cVersandInfo')->nullable();
            $table->dateTime('dVersandt')->nullable();
            $table->string('cIdentCode')->nullable();
            $table->char('cBeschreibung', 1)->nullable();
            $table->char('cInet', 1)->nullable();
            $table->dateTime('dLieferdatum')->nullable();
            $table->integer('kBestellHinweis')->nullable();
            $table->string('cErloeskonto')->nullable();
            $table->string('cWaehrung')->nullable();
            $table->double('fFaktor');
            $table->integer('kShop');
            $table->integer('kFirma');
            $table->integer('kLogistik')->nullable();
            $table->tinyInteger('nPlatform')->nullable();
            $table->integer('kSprache');
            $table->double('fGutschein');
            $table->dateTime('dGedruckt')->nullable();
            $table->dateTime('dMailVersandt')->nullable();
            $table->string('cInetBestellNr', 50)->nullable();
            $table->integer('kZahlungsArt')->nullable();
            $table->integer('kLieferAdresse')->nullable();
            $table->integer('kRechnungsAdresse')->nullable();
            $table->tinyInteger('nIGL')->nullable();
            $table->tinyInteger('nUStFrei')->nullable();
            $table->string('cStatus')->nullable();
            $table->dateTime('dVersandMail')->nullable();
            $table->dateTime('dZahlungsMail')->nullable();
            $table->string('cUserName')->nullable();
            $table->string('cVerwendungszweck')->nullable();
            $table->double('fSkonto');
            $table->integer('kColor')->nullable();
            $table->tinyInteger('nStorno')->nullable();
            $table->string('cModulID')->nullable();
            $table->integer('nZahlungsTyp')->nullable();
            $table->integer('nHatUpload')->nullable();
            $table->double('fZusatzGewicht');
            $table->tinyInteger('nKomplettAusgeliefert');
            $table->dateTime('dBezahlt')->nullable();
            $table->integer('kSplitBestellung')->nullable();
            $table->string('cPUIZahlungsdaten')->nullable();
            $table->tinyInteger('nPrio')->nullable();
            $table->string('cVersandlandISO', 5);
            $table->string('cUstId', 25)->nullable();
            $table->tinyInteger('nPremium');
            $table->string('cVersandlandWaehrung', 20);
            $table->double('fVersandlandWaehrungFaktor');
            $table->integer('kRueckhalteGrund');
            $table->string('cJfoid')->nullable();
            $table->integer('kFulfillmentLieferant')->nullable();
            $table->string('cKundenauftragsnummer')->nullable();
            $table->tinyInteger('nIstExterneRechnung');
            $table->string('cAmazonServiceLevel', 100)->nullable();
            $table->tinyInteger('nIstReadOnly');
            $table->string('cKampagne')->nullable();
            $table->string('cKampagneParam')->nullable();
            $table->string('cUserAgent')->nullable();
            $table->string('cReferrer')->nullable();
            $table->integer('nMax')->nullable();
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
        Schema::dropIfExists('jtl_tBestellung');
    }
}
