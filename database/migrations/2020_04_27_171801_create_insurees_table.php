<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsureesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('insurees', function (Blueprint $table) {
            $table->unsignedBigInteger('patient_id')->primary();
            $table->unsignedInteger('insurer_id');
            $table->string('insurance_id')->unique();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('insurer_id')->references('id')->on('insurers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('insurees');
    }
}
