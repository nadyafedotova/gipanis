<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJtlTkategorieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jtl_tkategorie', function (Blueprint $table) {
            $table->increments('kKategorie');
            $table->integer('kOberKategorie')->nullable();
            $table->char('cInet')->nullable();
            $table->char('cAktiv')->nullable();
            $table->char('cDelInet')->nullable();
            $table->integer('nSort')->nullable();
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
        Schema::dropIfExists('jtl_tkategorie');
    }
}
