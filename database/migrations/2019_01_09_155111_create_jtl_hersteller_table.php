<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJtlHerstellerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jtl_hersteller', function (Blueprint $table) {
            $table->increments('KHersteller');
            $table->string('cName')->nullable();
            $table->string('cHomepage')->nullable();
            $table->tinyInteger('nSort')->default(99);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jtl_hersteller');
    }
}
