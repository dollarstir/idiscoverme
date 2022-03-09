<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionSetupScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_setup_scores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('member_member_id');
            $table->foreign('member_member_id')->references('member_id')->on('members')->onDelete('cascade');
            $table->unsignedBigInteger('question_setup_id');
            $table->foreign('question_setup_id')->references('id')->on('question_setups')->onDelete('cascade');
            $table->string('institution_institution_id');
            $table->foreign('institution_institution_id')->references('institution_id')->on('institutions')->onDelete('cascade');
            $table->integer('age');
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
        Schema::dropIfExists('question_setup_scores');
    }
}
