<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 50)->unique();
            $table->string('description');
            $table->string('descripcion')->default('Pendiente');
            $table->decimal('price', 13, 4);
            $table->decimal('discounted_price', 13, 4);
            $table->string('type');
            $table->boolean('tax')->default(0);
            $table->unsignedBigInteger('category_id');

            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
