<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCareerPathScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_path_scores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('question_setup_score_id');
            $table->foreign('question_setup_score_id')->references('id')->on('question_setup_scores')->onDelete('cascade');
            $table->unsignedBigInteger('career_path_id');
            $table->foreign('career_path_id')->references('id')->on('career_paths')->onDelete('cascade');
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
        Schema::dropIfExists('career_path_scores');
    }
}
