<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalityCourseRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personality_course_related', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('personality_id');
            $table->foreign('personality_id')->references('id')->on('personalities')->onDelete('cascade');
            $table->unsignedBigInteger('personality_course_id');
            $table->foreign('personality_course_id')->references('id')->on('personality_courses')->onDelete('cascade');
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
        Schema::dropIfExists('personality_course_related');
    }
}
