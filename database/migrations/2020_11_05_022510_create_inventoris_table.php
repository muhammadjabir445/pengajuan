<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventoris', function (Blueprint $table) {
            $table->id();
            $table->string('kode',40)->unique();
            $table->text('detail');
            $table->integer('id_barang')->index();
            $table->integer('id_lantai')->index();
            $table->integer('id_ruangan')->index();
            $table->integer('id_user')->index();
            $table->tinyInteger('status')->default(0);
            $table->string('foto',180);
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
        Schema::dropIfExists('inventoris');
    }
}
