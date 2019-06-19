<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCronTriggerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cron_trigger', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 3)->default('php');
            $table->string('name');
            $table->tinyInteger('trigger')->default(0);
            $table->smallInteger('tries');
            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->string('status', 4);
            $table->text('comment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cron_trigger');
    }
}
