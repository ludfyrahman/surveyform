<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pembelian_id')->unsigned()->nullable();
            $table->integer('item_id')->unsigned();
            $table->integer('jumlah')->default(1);
            $table->integer('harga')->default(0);
            $table->integer('sub_total')->default(0);
            $table->enum('tipe', ['Barang', 'Jasa']);
            $table->enum('status', ['Proses', 'Done']);
            $table->timestamps();
            $table->foreign('pembelian_id')->references('id')->on('pembelian');
            // $table->foreign('item_id', 'item_barang_beli')->references('id')->on('barang');
            // $table->foreign('item_id', 'item_jasa_beli')->references('id')->on('jasa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian_detail');
    }
}
