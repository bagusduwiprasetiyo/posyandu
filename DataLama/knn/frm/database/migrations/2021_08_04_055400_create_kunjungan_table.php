<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKunjunganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kunjungan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kehamilan_id');
            $table->foreign('kehamilan_id')->references('id')->on('kehamilan')->cascadeOnDelete();
            $table->integer('bengkak_muka')->default(0);
            $table->integer('hidraniom')->default(0)->comment('Banyak air ketuban');
            $table->integer('bayi_mati')->default(0)->comment('bayi meninggal dalam kandungan');
            $table->integer('lebih_bulan')->default(0)->comment('kehamilan lebih bulan');
            $table->integer('sungsang')->default(0)->comment('posisi bayi sungsang');
            $table->integer('lintang')->default(0)->comment('posisi bayi letak lintang');
            $table->integer('pendarahan')->default(0)->comment('Pendarahan dalam kehamilan');
            $table->integer('peb')->default(0)->comment('PEB atau Eklamsia');
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
        Schema::dropIfExists('kunjungan');
    }
}
