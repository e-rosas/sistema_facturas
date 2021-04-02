<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceHospitalizationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_hospitalization_details', function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_id')->primary();
            $table->string('bill_type', 5)->nullable();
            $table->string('diagnosis_codes')->nullable();
            $table->boolean('breakdown')->default(0);
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
        Schema::dropIfExists('invoice_hospitalization_details');
    }
}
