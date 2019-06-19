<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJtlAttributTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jtl_attribut', function (Blueprint $table) {
            $table->increments('kAttribut');
            $table->tinyInteger('nIstMehrsprachig')->nullable();
            $table->tinyInteger('nIstFreifeld')->nullable();
            $table->integer('nSortierung')->nullable();
            $table->text('cBeschreibung')->nullable();
            $table->tinyInteger('nBezugstyp')->nullable();
            $table->tinyInteger('nAusgabeweg')->nullable();
            $table->tinyInteger('nIstStandard')->nullable();
            $table->integer('kFeldTyp')->nullable();
            $table->text('cRegEx')->nullable();
            $table->string('cGruppeName')->nullable();
            $table->tinyInteger('nReadOnly')->nullable();
            $table->binary('bRowversion')->nullable();
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
        Schema::dropIfExists('jtl_attribut');
    }
}
