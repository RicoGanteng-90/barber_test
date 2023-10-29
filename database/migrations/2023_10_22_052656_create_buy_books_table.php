<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('product_img');
            $table->string('customer')->nullable();
            $table->string('supplier')->nullable();
            $table->string('quantity');
            $table->string('price');
            $table->string('total')->nullable();
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
        Schema::dropIfExists('buy_books');
    }
};
