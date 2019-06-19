<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmzTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amz_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->index();
            $table->bigInteger('reportRequestId')->default(0);
            $table->bigInteger('GeneratedReportId')->default(0);
            $table->string('reportName');
            $table->timestamp('startDate')->nullable();
            $table->timestamp('endDate')->nullable();
            $table->string('status');
            $table->tinyInteger('imported')->default(0);
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
        Schema::dropIfExists('amz_tasks');
    }
}
