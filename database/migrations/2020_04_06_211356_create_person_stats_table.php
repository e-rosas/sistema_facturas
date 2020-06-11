<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonStatsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('person_stats', function (Blueprint $table) {
            $table->unsignedBigInteger('patient_id')->primary();
            $table->decimal('amount_paid', 13, 4)->default(0);
            $table->decimal('amount_due', 13, 4)->default(0);
            $table->decimal('amount_paid_mxn', 13, 4)->default(0);
            $table->decimal('amount_due_mxn', 13, 4)->default(0);
            $table->decimal('total_amount_due', 13, 4)->default(0);
            $table->tinyInteger('status')->default(0);
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('person_stats');
    }
}
