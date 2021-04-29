<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('location_id')->default(1);
            $table->unsignedBigInteger('insurance_id');
            $table->string('series')->nullable();
            $table->string('number')->nullable();
            $table->string('code', 50)->unique();
            $table->string('concept')->default('Factura dólares Aseguranza');
            $table->string('currency')->default('USD');
            $table->date('date');
            $table->date('DOS'); //date of service
            $table->decimal('exchange_rate', 13, 4)->default(0);
            $table->boolean('registered')->default(0); //facturada
            $table->boolean('hospitalization')->default(0);
            $table->boolean('cash')->default(0);

            $table->decimal('tax', 13, 4)->default(0);
            $table->decimal('dtax', 13, 4)->default(0);
            $table->decimal('sub_total', 13, 4)->default(0);
            $table->decimal('sub_total_discounted', 13, 4)->default(0);
            $table->decimal('total', 13, 4)->default(0);
            $table->decimal('total_with_discounts', 13, 4)->default(0);
            $table->decimal('amount_paid', 13, 4)->default(0);
            $table->decimal('amount_due', 13, 4)->default(0);
            $table->decimal('amount_credit', 13, 4)->default(0);

            $table->string('doctor')->default('Pendiente');
            $table->boolean('dental')->default(0);

            $table->boolean('accept_assignment')->default(0);

            $table->tinyInteger('type')->default(0);
            $table->text('comments')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->foreign('patient_id')->references('id')->on('patients')->cascadeOnDelete();
            $table->foreign('location_id')->references('id')->on('locations')->cascadeOnDelete();
            $table->foreign('insurance_id')->references('id')->on('insurances')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}