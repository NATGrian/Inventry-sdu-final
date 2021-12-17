<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_ingredients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('CID')->unsigned();
            $table->string('itemname');
            $table->bigInteger('qty');
            $table->string('image')->default('ingredients-demo.png');
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
        Schema::dropIfExists('item_ingredients');
    }
}
