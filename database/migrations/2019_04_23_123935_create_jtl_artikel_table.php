<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJtlArtikelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jtl_artikel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kArtikel')->unique();
            $table->string('cArtNr');
            $table->decimal('fVKNetto', 28, 14);
            $table->decimal('fUVP', 28, 14);
            $table->mediumText('cAnmerkung');
            $table->char('cPreisliste', 1);
            $table->char('cAktiv', 1);
            $table->decimal('nLagerbestand', 28, 14);
            $table->decimal('nMindestbestellmaenge', 28, 14);
            $table->string('cBarcode');
            $table->string('cErloeskonto', 64);
            $table->char('cTopArtikel', 1);
            $table->char('cInet', 1);
            $table->char('cDelInet', 1);
            $table->decimal('fGewicht', 28, 14);
            $table->char('cNeu', 1);
            $table->char('cLagerArtikel', 1);
            $table->char('cTeilbar', 1);
            $table->char('cLagerAktiv');
            $table->char('cLagerKleinerNull');
            $table->decimal('nMidestbestand', 28, 14);
            $table->decimal('fEKNetto', 28, 14);
            $table->decimal('fEbayPreis', 28, 14);
            $table->char('cLagerVariation');
            $table->tinyInteger('nDelete');
            $table->dateTime('dMod');
            $table->decimal('fPackeinheit', 28, 14);
            $table->tinyInteger('nVPE');
            $table->tinyInteger('fVPEWert');
            $table->string('cSuchbegriffe');
            $table->string('cTaric', 20);
            $table->string('cHerkunftsland', 64);
            $table->integer('kSteuerklasse');
            $table->dateTime('dErstelldatum');
            $table->dateTime('dErscheinungsdatum');
            $table->integer('nSort');
            $table->integer('kVersandklasse');
            $table->decimal('fArtGewicht', 28, 14);
            $table->string('cHAN');
            $table->string('cSerie');
            $table->string('cISBN');
            $table->string('cUNNummer');
            $table->string('cGefahrnr');
            $table->string('cASIN');
            $table->integer('kEigenschaftKombi');
            $table->integer('kVaterArtikel');
            $table->tinyInteger('nIstVater');
            $table->tinyInteger('nIstMindestbestand');
            $table->decimal('fAbnahmeintervall', 28, 14);
            $table->integer('kStueckliste');
            $table->string('cUPC');
            $table->integer('kWarengruppe');
            $table->string('cEPID');
            $table->tinyInteger('nMHD');
            $table->tinyInteger('nCharge');
            $table->tinyInteger('nNichtBestellbar');
            $table->decimal('fAmazonVK', 28, 14);
            $table->tinyInteger('nPufferTyp');
            $table->integer('nPuffer');
            $table->tinyInteger('nProzentualePreisStaffelAktiv');
            $table->tinyInteger('nSeriennummernVerfolgung');
            $table->integer('kHersteller');
            $table->integer('kLieferStatus');
            $table->integer('kMassEinheit');
            $table->decimal('fMassMenge', 28, 14);
            $table->integer('kGrundPreisEinheit');
            $table->decimal('fGrundpreisMenge');
            $table->decimal('fBreite');
            $table->decimal('fHoehe');
            $table->decimal('fLaenge');
            $table->integer('kVPEEinheit');
            $table->integer('nLiefertageWennAusverkauft');
            $table->integer('kVerkaufsEinheit');
            $table->integer('nBearbeitungszeit');
            $table->dateTime('dZulaufVerfuegbarAm');
            $table->tinyInteger('nAutomatischeLiefertageberechnung');
            $table->decimal('fLetzterEK');
            $table->dateTime('dLetzterEK');
            $table->integer('kBenutzerLetzteAenderung');
            $table->decimal('nZulaufVerfuegbarMenge');
            $table->dateTime('dNeuImSortiment');
            $table->tinyInteger('nEbayAbgleich');
            $table->string('cAmazonFNSKU');
            $table->integer('kZustand');
            $table->string('cJfpid');
            $table->integer('nPaketlaufzeitMin');
            $table->integer('nPaketlaufzeitMax');
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
        Schema::dropIfExists('jtl_artikel');
    }
}
