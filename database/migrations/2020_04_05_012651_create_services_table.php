<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 50)->unique();
            $table->string('description')->default('Pending');
            $table->string('descripcion')->default('Pendiente');
            $table->decimal('price', 13, 4)->default(0);
            $table->decimal('discounted_price', 13, 4)->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('category_id')->default(8);
            $table->string('SAT')->default('Pendiente');
            $table->string('SAT_code')->default('Pendiente');

            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
