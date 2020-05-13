<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('charges', function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_id')->primary();
            $table->decimal('original_amount_due', 13, 4);
            $table->decimal('amount_charged', 13, 4);
            $table->decimal('exchange_rate', 13, 4);
            $table->date('date');
            $table->string('number');
            $table->tinyInteger('status')->default(0);
            $table->text('comments')->nullable();
            $table->foreign('invoice_id')->references('id')->on('invoices')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('charges');
    }
}
