<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmzProductListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amz_product_list', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->index();
            $table->string('ASIN', 32);
            $table->string('EAN', 32);
            $table->string('status')->nullable();
            $table->string('Binding')->nullable();
            $table->string('Brand')->nullable();
            $table->string('Color')->nullable();
            $table->text('Feature')->nullable();
            $table->string('ItemDimensions');
            $table->string('Label')->nullable();
            $table->double('Amount')->default(0);
            $table->string('CurrencyCode')->nullable();
            $table->string('Manufacturer')->nullable();
            $table->string('MaterialType')->nullable();
            $table->string('PackageDimensions')->nullable();
            $table->string('PackageQuantity');
            $table->string('PartNumber')->index();
            $table->string('ProductGroup')->nullable();
            $table->string('ProductTypeName')->nullable();
            $table->string('Publisher')->nullable();
            $table->string('SmallImageURL')->nullable();
            $table->string('SmallImageHeight')->nullable();
            $table->string('SmallImageWidth')->nullable();
            $table->string('Title')->nullable();
            $table->string('SalesRank')->nullable();
            $table->timestamps();
            $table->index(['store_id','ASIN', 'EAN']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amz_product_list');
    }
}
