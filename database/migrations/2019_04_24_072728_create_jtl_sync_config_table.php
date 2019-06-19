<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJtlSyncConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jtl_sync_config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('tableJTL');
            $table->string('tableV');
            $table->decimal('timer_d');
            $table->decimal('timer_h');
            $table->boolean('only_new');
            $table->tinyInteger('status');
            $table->timestamp('lastSync')->nullable();
            $table->time('execution_t')->nullable();
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
        Schema::dropIfExists('jtl_sync_config');
    }
}
