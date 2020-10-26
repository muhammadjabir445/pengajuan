<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_barang')->index();
            $table->double('perkiraan_harga',9,0);
            $table->float('total',3,0);
            $table->text('keterangan')->nullable();
            $table->text('tujuan_pengadaan')->nullable();
            $table->tinyInteger('status_pengajuan')->default(0);
            $table->text('alasan_tolak')->nullable();
            $table->integer('created_by');
            $table->integer('id_divisi');
            $table->integer('id_parent');
            $table->softDeletes();
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
        Schema::dropIfExists('pengajuans');
    }
}
