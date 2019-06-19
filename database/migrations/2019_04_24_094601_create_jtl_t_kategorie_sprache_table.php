<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJtlTKategorieSpracheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jtl_tKategorieSprache', function (Blueprint $table) {
            $table->integer('kKategorie');
            $table->integer('kSprache');
            $table->string('cName');
            $table->binary('cBeschreibung', 4000)->nullable();
            $table->integer('kPlattform');
            $table->integer('kShop');
            $table->string('cUrlPfad')->nullable();
            $table->binary('cTitleTag', 4000)->nullable();
            $table->binary('cMetaDescription', 4522)->nullable();
            $table->binary('cMetaKeywords', 4000)->nullable();
            $table->integer('kKategorieSprache');
            $table->timestamps();

            $table->primary(['kKategorie', 'kSprache']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jtl_tKategorieSprache');
    }
}
