<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerminalReportSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminal_report_setups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('question_setup_score_id');
            $table->foreign('question_setup_score_id')->references('id')->on('question_setup_scores')->onDelete('cascade');
            $table->unsignedBigInteger('level_id');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->unsignedBigInteger('marking_scheme_id');
            $table->foreign('marking_scheme_id')->references('id')->on('marking_schemes')->onDelete('cascade');
            $table->string('member_member_id');
            $table->foreign('member_member_id')->references('member_id')->on('members')->onDelete('cascade');
            $table->enum('term',["1","2","3"])->default("1");
            $table->string('institution_institution_id');
            $table->foreign('institution_institution_id')->references('institution_id')->on('institutions')->onDelete('cascade');
            $table->unsignedBigInteger('class_name_id');
            $table->foreign('class_name_id')->references('id')->on('class_names')->onDelete('cascade');
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
        Schema::dropIfExists('terminal_report_setups');
    }
}
