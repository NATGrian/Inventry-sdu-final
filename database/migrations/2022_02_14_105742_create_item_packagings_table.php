<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemPackagingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_packagings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('CID')->unsigned();
            $table->string('itemname');
            $table->double('qty', 15, 2);
            $table->string('image')->default('packagings-demo.png');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('item_packagings');
    }
}
