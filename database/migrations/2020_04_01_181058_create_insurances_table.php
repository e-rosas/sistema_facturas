<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('insuree_id');
            $table->unsignedBigInteger('insurer_id');
            $table->string('group_number', 50)->nullable();
            $table->string('insurance_id', 50)->unique();
            $table->tinyInteger('type')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->string('group_phone_number')->nullable();
            $table->foreign('insuree_id')->references('patient_id')->on('insurees')->cascadeOnDelete();
            $table->foreign('insurer_id')->references('id')->on('insurers')->cascadeOnDelete();
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('insurances');
    }
}
