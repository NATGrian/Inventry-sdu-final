<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelevantGroupsTable extends Migration
{

    public function up()
    {
        Schema::create('relevant_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role');
            $table->string('description')->nullable();
        });
    }


    public function down()
    {
        Schema::dropIfExists('relevant_groups');
    }
}
