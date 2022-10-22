<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice');
            $table->date('tanggal')->useCurrent();
            $table->integer('supplier_id')->unsigned();
            $table->integer('total')->default(0);
            $table->enum('tipe_transaksi',['Online', 'Offline'])->default('Offline');
            $table->enum('status',['Proses', 'Done'])->default('Proses');
            $table->timestamps();
            $table->foreign('supplier_id')->references('id')->on('supplier');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian');
    }
}
