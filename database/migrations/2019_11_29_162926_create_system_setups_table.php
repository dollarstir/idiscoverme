<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_setups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('software_name');
            $table->string('software_short_name');
            $table->string('organization_name');
            $table->longtext('organization_logo')->nullable();
            $table->longtext('homepage_logo')->nullable();
            $table->longtext('header_logo')->nullable();
            $table->longtext('favicon')->nullable();
            $table->string('color');
            $table->string('organization_location')->nullable();
            $table->string('organization_gps_address')->nullable();
            $table->string('organization_pobox')->nullable();
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
        Schema::dropIfExists('system_setups');
    }
}
