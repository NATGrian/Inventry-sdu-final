<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExportProductItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export_product_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idproduct')->unsigned();
            $table->integer('UID')->unsigned();
            $table->integer('PID')->unsigned();
            $table->date('export_at');
            $table->string('order_no',50);
            $table->double('qty_charge', 15, 2);
            $table->double('qty', 15, 2);
            $table->string('description')->nullable();
            $table->string('status',50);
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('export_product_items');
    }
}
