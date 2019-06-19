<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJtlMerkmalSpracheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jtl_merkmal_sprache', function (Blueprint $table) {
            $table->integer('kMerkmal');
            $table->integer('kSprache');
            $table->string('cName');
            $table->binary('bRowversion');
            $table->timestamps();

            $table->primary(['kMerkmal', 'kSprache']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jtl_merkmal_sprache');
    }
}
