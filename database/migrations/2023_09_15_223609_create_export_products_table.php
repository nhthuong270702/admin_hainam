<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export_products', function (Blueprint $table) {
            $table->id();
            $table->text('date')->nullable();
            $table->text('document')->nullable();
            $table->string('quanity')->nullable();
            $table->string('price')->nullable();
            $table->string('buyer_name')->nullable();
            $table->string('buyer_phone')->nullable();
            $table->string('buyer_address')->nullable();
            $table->string('buyer_driver')->nullable();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('export_products');
    }
}
