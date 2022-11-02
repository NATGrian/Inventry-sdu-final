<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelevantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relevants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('GID')->unsigned();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('image')->default('avatar.png');
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
        Schema::dropIfExists('relevants');
    }
}
