<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJtlTbestellposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jtl_tbestellpos', function (Blueprint $table) {
            $table->integer('kBestellPos');
            $table->integer('tArtikel_kArtikel');
            $table->integer('tBestellung_kBestellung');
            $table->tinyInteger('nType');
            $table->string('cArtNr', 100);
            $table->double('nAnzahl');
            $table->double('fVKPreis');
            $table->string('cOrderItemId');
            $table->double('fMwSt');
            $table->double('fRabatt');
            $table->string('cString');
            $table->double('fVKNetto');
            $table->string('cHinweis', 2000);
            $table->integer('nHatUpload');
            $table->string('cUnique', 30);
            $table->integer('kKonfigitem', 11);
            $table->tinyInteger('nDropshipping');
            $table->double('fEKNetto');
            $table->string('cItemID');
            $table->string('cTransactionID');
            $table->integer('kAmazonBestellungPos');
            $table->integer('nSort');
            $table->integer('kBestellStueckliste');
            $table->string('cStringStandard');
            $table->string('cEinheit');
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
        Schema::dropIfExists('jtl_tbestellpos');
    }
}
