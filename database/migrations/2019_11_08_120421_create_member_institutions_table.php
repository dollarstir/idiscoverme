<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_institutions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('member_member_id');
            $table->foreign('member_member_id')->references('member_id')->on('members')->onDelete('cascade');
            $table->string('institution_institution_id');
            $table->foreign('institution_institution_id')->references('institution_id')->on('institutions')->onDelete('cascade');
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
        Schema::dropIfExists('member_institutions');
    }
}
