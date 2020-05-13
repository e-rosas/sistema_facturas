<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLettersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('letters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('charge_id');
            $table->date('date');
            $table->string('number');
            $table->string('file_path')->nullable();
            $table->text('comments')->nullable();
            $table->foreign('charge_id')->references('invoice_id')->on('charges')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('letters');
    }
}
