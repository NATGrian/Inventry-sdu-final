<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->string('firstname', 80);
            $table->string('lastname', 80);
            $table->string('phone', 10);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('image')->default('avatar.png');
            $table->string('api_token')->nullable();
            $table->rememberToken();
            $table->string('passwordResetCode')->nullable();
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
        Schema::dropIfExists('users');
    }
}
