<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokenKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token_keys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('token_key');
            $table->string('institution_institution_id');
            $table->foreign('institution_institution_id')->references('institution_id')->on('institutions')->onDelete('cascade');
            $table->string('member_member_id');
            $table->foreign('member_member_id')->references('member_id')->on('members')->onDelete('cascade');
            $table->enum('isActive', ['0', '1'])->default('1');
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
        Schema::dropIfExists('token_keys');
    }
}
