<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJtlArtikelAttributTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jtl_artikel_attribut', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kArtikelAttribut');
            $table->integer('kArtikel');
            $table->integer('kAttribut');
            $table->integer('kShop');
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
        Schema::dropIfExists('jtl_artikel_attribut');
    }
}
