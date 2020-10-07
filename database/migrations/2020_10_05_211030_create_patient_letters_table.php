<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientLettersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('patient_letters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->date('date');
            $table->text('content')->nullable();
            $table->text('reply')->nullable();
            $table->tinyInteger('status')->default(0);

            $table->text('comments')->nullable();
            $table->foreign('patient_id')->references('id')->on('patients')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('patient_letters');
    }
}