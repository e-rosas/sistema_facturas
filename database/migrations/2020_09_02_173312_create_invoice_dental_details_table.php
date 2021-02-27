<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDentalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('invoice_dental_details', function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_id')->primary();
            $table->boolean('enclosures')->default(0);
            $table->boolean('orthodontics')->default(0);
            $table->date('appliance_placed')->nullable();
            $table->tinyInteger('months_remaining')->default(0);
            $table->boolean('prosthesis_replacement')->default(0);
            $table->tinyInteger('treatment_resulting_from')->default(0);
            $table->date('prior_placement')->nullable();
            $table->date('accident')->nullable();
            $table->string('auto_accident_state')->nullable();
            $table->string('license');
            $table->string('tooth_numbers')->nullable();
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('invoice_dental_details');
    }
}