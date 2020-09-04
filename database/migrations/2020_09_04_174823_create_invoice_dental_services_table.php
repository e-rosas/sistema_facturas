<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDentalServicesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('invoice_dental_services', function (Blueprint $table) {
            $table->unsignedBigInteger('diagnosis_service_id')->primary();
            $table->string('oral_cavity')->nullable();
            $table->string('tooth_system')->nullable();
            $table->string('tooth_numbers')->nullable();
            $table->string('tooth_surfaces')->nullable();
            $table->foreign('diagnosis_service_id')->references('id')->on('diagnosis_services')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('invoice_dental_services');
    }
}