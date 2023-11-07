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
        Schema::create('jual_layanans', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal_transaksi')->nullable();
            $table->string('layanan')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('customer')->nullable();
            $table->string('total_harga')->nullable();
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
        Schema::dropIfExists('jual_layanans');
    }
};
