<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJtlArtikelBeschreibungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jtl_artikel_beschreibung', function (Blueprint $table) {
            $table->integer('kArtikel');
            $table->integer('kSprache');
            $table->integer('kPlattform');
            $table->integer('kShop');
            $table->string('cName');
            $table->longText('cBeschreibung');
            $table->longText('cKurzBeschreibung');
            $table->string('cUrlPfad');
            $table->longText('cTitleTag');
            $table->longText('cMetaKeywords');
            $table->longText('cMetaDescription');
            $table->binary('bRowversion');
            $table->timestamps();

            $table->primary(['kArtikel', 'kSprache', 'kPlattform', 'kShop']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jtl_artikel_beschreibung');
    }
}
