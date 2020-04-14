<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('invoice_id');
            $table->string('number');
            $table->decimal('exchange_rate', 13, 4);
            $table->decimal('amount_paid', 13, 4);
            $table->string('method')->default('Por definir');
            $table->tinyInteger('concept')->default(0);
            $table->date('date');
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
        Schema::dropIfExists('payments');
    }
}
