<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengembalianBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengembalian_buku', function (Blueprint $table) {
            $table->bigIncrements('id_kbuku');
            $table->unsignedBigInteger('id_pbuku');
            $table->date('tgl_kembali');
            $table->integer('denda');

            $table->foreign('id_pbuku')->references('id_pbuku')->on('peminjaman_buku');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengembalian_buku');
    }
}
