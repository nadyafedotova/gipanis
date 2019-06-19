<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJtlTPlattformTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jtl_tPlattform', function (Blueprint $table) {
            $table->increments('nPlattform');
            $table->string('cID')->nullable();
            $table->string('cName')->nullable();
            $table->integer('nInet')->nullable();
            $table->string('cWaehrung')->nullable();
            $table->integer('nTyp');
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
        Schema::dropIfExists('jtl_tPlattform');
    }
}
