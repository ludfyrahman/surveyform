<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('satuan_id')->unsigned();
            $table->integer('kategori_id')->unsigned();
            $table->string('kode');
            $table->string('nama');
            $table->integer('stok')->default(0);
            $table->integer('harga_jual')->default(0);
            $table->integer('harga_beli')->default(0);
            $table->string('foto')->default('-');
            $table->date('expired_date');
            $table->text('deskripsi');
            $table->enum('status', ['Aktif', 'Nonaktif']);
            $table->timestamps();
            $table->foreign('satuan_id')->references('id')->on('satuan');
            $table->foreign('kategori_id')->references('id')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
