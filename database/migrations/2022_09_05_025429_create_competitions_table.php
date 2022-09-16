<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->id('kode_lomba');
            $table->timestamps();
            $table->string('nama_lomba');
            $table->integer('min_anggota');
            $table->integer('max_anggota');
            $table->integer('kategori');
            $table->string('desc');
            $table->date('batas_pendaftaran');
            $table->string('url_guidebook');
            $table->string('maskot');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competitions');
    }
};
