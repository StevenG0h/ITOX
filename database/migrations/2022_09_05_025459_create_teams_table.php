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
        Schema::create('teams', function (Blueprint $table) {
            $table->id('kode_tim');
            $table->unsignedBigInteger('kode_lomba');
            $table->unsignedBigInteger('kode_ketua')->nullable();
            $table->string('nama_tim');
            $table->string('nomor_hp');
            $table->string('institusi_asal')->nullable();
            $table->string('jenis_institusi')->nullable();
            $table->timestamps();

            
        });
        Schema::table('teams', function (Blueprint $table){
            $table->foreign('kode_lomba')->references('kode_lomba')->on('competitions')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
};
