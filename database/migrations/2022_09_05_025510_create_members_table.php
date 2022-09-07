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
        Schema::create('members', function (Blueprint $table) {
            $table->id('member_id');
            $table->unsignedBigInteger('kode_tim');
            $table->string('nama');
            $table->string('url_dokumen');
            $table->timestamps();
        });
        Schema::table('members',function(Blueprint $table){
            $table->foreign('kode_tim')->references('kode_tim')->on('teams')->cascadeOnDelete()->cascadeOnUpdate();
        });
        Schema::table('teams',function(Blueprint $table){
            $table->foreign('kode_ketua')->references('member_id')->on('members')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
};
