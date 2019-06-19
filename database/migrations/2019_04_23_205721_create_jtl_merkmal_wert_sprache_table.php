<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJtlMerkmalWertSpracheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jtl_merkmal_wert_sprache', function (Blueprint $table) {
            $table->integer('kMerkmalWert');
            $table->integer('kSprache');
            $table->string('cWert')->nullable();
            $table->string('cSeo')->nullable();
            $table->string('cMetaTitle')->nullable();
            $table->string('cMetaKeywords')->nullable();
            $table->text('cMetaDescription')->nullable();
            $table->text('cBeschreibung')->nullable();
            $table->binary('bRowversion');
            $table->timestamps();

            $table->primary(['kMerkmalWert', 'kSprache']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jtl_merkmal_wert_sprache');
    }
}
