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
            $table->unsignedBigInteger('insurer_id');
            $table->string('insurance_id', 50)->unique();
            $table->string('nss', 20)->unique();
            $table->string('group_number', 20);
            $table->foreign('patient_id')->references('id')->on('patients')->cascadeOnDelete();
            $table->foreign('insurer_id')->references('id')->on('insurers')->cascadeOnDelete();
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