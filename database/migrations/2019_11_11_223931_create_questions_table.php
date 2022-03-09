<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('question_number');
            $table->unsignedBigInteger('question_setup_id');
            $table->foreign('question_setup_id')->references('id')->on('question_setups')->onDelete('cascade');
            $table->unsignedBigInteger('career_path_id');
            $table->foreign('career_path_id')->references('id')->on('career_paths')->onDelete('cascade');
            $table->string('question');
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
        Schema::dropIfExists('questions');
    }
}
