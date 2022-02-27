<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExportPackagingsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export_packagings_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idpack')->unsigned();
            $table->integer('UID')->unsigned();
            $table->integer('PID')->unsigned();
            $table->string('rc_no',50);
            $table->string('LOT_no',50);
            $table->date('export_at');
            $table->string('invoice_no',50)->nullable();
            $table->double('qty_charge', 15, 5);
            $table->double('qty_balance', 15, 5);
            $table->string('description')->nullable();
            $table->string('code_product',50)->nullable();
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
        Schema::dropIfExists('export_packagings_items');
    }
}
