<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->increments('id_produk');
            $table->unsignedBigInteger('id_kategori');
            $table->string('nama_produk');
            $table->string('merek')->nullable();
            $table->Integer('harga_beli');
            $table->Integer('harga_jual');
            $table->tinyInteger('diskon')->default(0);
            $table->integer('stok');
            $table->timestamps();

           
                // $table->foreign('prodi_id')->references('id')->on('prodi_tabel')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('id_kategori')->references('id_kategori')->on('kategoris')->onDelete('restrict')->onUpdate('restrict');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produks');
    }
}
