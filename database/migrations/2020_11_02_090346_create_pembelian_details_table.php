<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_details', function (Blueprint $table) {
            $table->id();
            $table->integer('id_barang')->index();
            $table->integer('id_pengajuan')->index();
            $table->integer('id_pembelian')->index();
            $table->integer('input_by')->nullable()->index();
            $table->double('harga',9,0)->nullable();
            $table->string('tempat_beli',150)->nullable();
            $table->string('foto',180)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian_details');
    }
}
