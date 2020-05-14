<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDiagnosisListsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('invoice_diagnosis_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('diagnosis_id');
            $table->unsignedBigInteger('invoice_diagnoses_id');
            $table->string('diagnosis_code')->default('Pendiente');
            $table->foreign('diagnosis_id')->references('id')->on('diagnoses')->onDelete('cascade');
            $table->foreign('invoice_diagnoses_id')->references('id')->on('invoice_diagnoses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('invoice_diagnosis_lists');
    }
}
