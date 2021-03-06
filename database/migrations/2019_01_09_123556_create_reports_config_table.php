<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports_config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 8)->unique();
            $table->string('name_table', 50);
            $table->string('name', 50);
            $table->string('action', 50)->unique();
            $table->string('group', 8)->index();
            $table->text('schedules')->nullable();
            $table->tinyInteger('history');
            $table->text('schedules_history')->nullable();
            $table->string('countries')->nullable();
            $table->text('message')->nullable();
            $table->string('status', 16)->nullable();
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
        Schema::dropIfExists('reports_config');
    }
}
