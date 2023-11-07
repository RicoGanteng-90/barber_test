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
        Schema::create('kelola_peenjualans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_customer')->nullable();
            $table->string('email_customer')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('tanggal_transaksi')->nullable();
            $table->string('tanggal_pemesanan')->nullable();
            $table->string('barang')->nullable();
            $table->string('jumlah')->nullable();
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
        Schema::dropIfExists('kelola_peenjualans');
    }
};
