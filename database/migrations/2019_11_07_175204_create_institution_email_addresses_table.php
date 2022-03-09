<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionEmailAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institution_email_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('institution_institution_id');
            $table->foreign('institution_institution_id')->references('institution_id')->on('institutions')->onDelete('cascade');
            $table->string('address')->unique();
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
        Schema::dropIfExists('institution_email_addresses');
    }
}
