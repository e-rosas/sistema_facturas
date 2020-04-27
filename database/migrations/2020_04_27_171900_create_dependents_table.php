<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('dependents', function (Blueprint $table) {
            $table->unsignedBigInteger('patient_id')->primary();
            $table->unsignedBigInteger('insuree_id');
            $table->tinyInteger('relationship')->default(0);
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('insuree_id')->references('patient_id')->on('insurees')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('dependents');
    }
}
