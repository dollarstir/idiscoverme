<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institution_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('institution_institution_id');
            $table->foreign('institution_institution_id')->references('institution_id')->on('institutions')->onDelete('cascade');
            $table->string('phoneNumber')->unique();
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
        Schema::dropIfExists('institution_contacts');
    }
}
