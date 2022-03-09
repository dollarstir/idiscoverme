<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDorminantPersonalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dorminant_personalities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('position');
            $table->unsignedBigInteger('question_setup_score_id');
            $table->foreign('question_setup_score_id')->references('id')->on('question_setup_scores')->onDelete('cascade');
            $table->unsignedBigInteger('personality_id');
            $table->foreign('personality_id')->references('id')->on('personalities')->onDelete('cascade');
            $table->integer('score');
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
        Schema::dropIfExists('dorminant_personalities');
    }
}
