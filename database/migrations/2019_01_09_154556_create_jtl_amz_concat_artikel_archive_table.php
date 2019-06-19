<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJtlAmzConcatArtikelArchiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jtl_amz_concat_artikel_archive', function (Blueprint $table) {
            $table->increments('kArtikel');
            $table->string('cArtNr');
            $table->string('cHAN');
            $table->string('SKU');
            $table->string('ASIN');
            $table->string('CBarcode');
            $table->string('EAN');
            $table->string('kVaterArtikel');
            $table->string('kType', 4);
            $table->string('cAktiv', 1);
            $table->string('status', 16);
            $table->json('changed');
            $table->tinyInteger('EndOFLife');
            $table->tinyInteger('AMALogik');
            $table->timestamp('open_date')->nullable();
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
        Schema::dropIfExists('jtl_amz_concat_artikel_archive');
    }
}
