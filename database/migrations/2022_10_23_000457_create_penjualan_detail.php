<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('penjualan_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->integer('jumlah')->default(1);
            $table->integer('harga')->default(0);
            $table->integer('sub_total')->default(0);
            $table->enum('tipe', ['Barang', 'Jasa']);
            $table->enum('status', ['Proses', 'Done']);
            $table->timestamps();
            $table->foreign('penjualan_id')->references('id')->on('penjualan');
            $table->foreign('item_id', 'item_barang')->references('id')->on('barang');
            $table->foreign('item_id', 'item_jasa')->references('id')->on('jasa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualan_detail');
    }
}
