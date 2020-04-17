<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->decimal('value', 13, 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('rates');
    }
}
