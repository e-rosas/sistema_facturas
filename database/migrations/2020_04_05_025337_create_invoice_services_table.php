<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceServicesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('invoice_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('service_id');
            $table->string('code');
            $table->string('description');
            $table->string('descripcion')->default('Pendiente');
            $table->decimal('price', 13, 4);
            $table->decimal('discounted_price', 13, 4);
            $table->integer('quantity');
            $table->decimal('tax', 13, 4);
            $table->decimal('dtax', 13, 4);
            $table->decimal('sub_total', 13, 4);
            $table->decimal('sub_total_discounted', 13, 4);
            $table->decimal('total_price', 13, 4);
            $table->decimal('total_discounted_price', 13, 4);
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('invoice_services');
    }
}
