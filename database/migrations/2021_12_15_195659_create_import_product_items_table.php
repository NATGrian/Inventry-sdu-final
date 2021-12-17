<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportProductItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_product_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idproduct')->unsigned();
            $table->integer('UID')->unsigned();
            $table->integer('PID')->unsigned();
            $table->string('Batch_no',50)->nullable();
            $table->date('import_at');
            $table->date('MFG');
            $table->date('EXP');
            $table->double('qty_charge', 15, 2);
            $table->double('qty', 15, 2);
            $table->string('description')->nullable();
            $table->integer('storageID')->unsigned();
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
        Schema::dropIfExists('import_product_items');
    }
}
