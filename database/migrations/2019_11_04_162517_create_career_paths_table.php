<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCareerPathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_paths', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('personality_id');
            $table->foreign('personality_id')->references('id')->on('personalities')->onDelete('cascade');
            $table->string('name');
            $table->string('alternative_name');
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
        Schema::dropIfExists('career_paths');
    }
}
