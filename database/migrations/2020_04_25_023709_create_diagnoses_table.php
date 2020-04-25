<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 10)->unique();
            $table->string('name')->default('Pending');
            $table->string('nombre')->default('Pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('diagnoses');
    }
}
