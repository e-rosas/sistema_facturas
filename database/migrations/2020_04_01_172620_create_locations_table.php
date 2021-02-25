<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('first_line', 43);
            $table->string('second_line', 43);
            $table->string('third_line', 43)->nullable();
            $table->string('fourth_line', 43);
            $table->string('phone_number')->nullable();

            $table->string('billing_first_line', 43);
            $table->string('billing_second_line', 43);
            $table->string('billing_third_line', 43)->nullable();
            $table->string('billing_fourth_line', 43)->nullable();

            $table->boolean('default')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}