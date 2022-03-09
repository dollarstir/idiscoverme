<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTerminalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_terminals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('terminal_report_setup_id');
            $table->foreign('terminal_report_setup_id')->references('id')->on('terminal_report_setups')->onDelete('cascade');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->decimal("class_score",10,2);
            $table->decimal("exams_score",10,2);
            $table->decimal("total",10,2);
            $table->integer("position");
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
        Schema::dropIfExists('member_terminals');
    }
}
