<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_peminjaman', function (Blueprint $table) {
            $table->bigIncrements('id_dpbuku');
            $table->unsignedBigInteger('id_pbuku');
            $table->unsignedBigInteger('id_buku');
            $table->integer('qty');

            $table->foreign('id_pbuku')->references('id_pbuku')->on('peminjaman_buku');
            $table->foreign('id_buku')->references('id_buku')->on('buku');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_peminjaman');
    }
}
