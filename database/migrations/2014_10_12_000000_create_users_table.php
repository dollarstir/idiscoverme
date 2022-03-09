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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('title_id');
            $table->foreign('title_id')->references('id')->on('titles')->onDelete('cascade');
            $table->string('firstName');
            $table->string('middleName')->nullable();
            $table->string('lastName');
            $table->enum('gender', ['0', '1'])->default('0');
            $table->longtext('photo')->nullable();
            $table->string('password');
            $table->enum('account_status', ['0', '1'])->default('1');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
