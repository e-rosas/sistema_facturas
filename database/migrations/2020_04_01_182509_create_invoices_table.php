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
            $table->string('series');
            $table->string('number');
            $table->string('concept')->default('Factura dólares Aseguranza');
            $table->string('currency')->default('USD');
            $table->string('method')->default('Por definir');
            $table->date('date');
            $table->decimal('exchange_rate', 13, 4);
            $table->decimal('IVA', 13, 4);
            $table->decimal('IVA_applied', 13, 4);
            $table->decimal('subtotal', 13, 4);
            $table->decimal('total', 13, 4);
            $table->decimal('amount_due', 13, 4);
            $table->tinyInteger('type')->default(0);
            $table->text('comments')->nullable();
            $table->string('status')->default('Complemento pendiente');
            $table->foreign('patient_id')->references('id')->on('patients')->cascadeOnDelete();
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
