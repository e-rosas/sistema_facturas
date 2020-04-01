<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('credits', function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_id');
            $table->string('series');
            $table->string('number');
            $table->decimal('original_amount_due', 13, 4);
            $table->decimal('amount_due', 13, 4);
            $table->string('concept')->default('Nota de credito');
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
        Schema::dropIfExists('credits');
    }
}
