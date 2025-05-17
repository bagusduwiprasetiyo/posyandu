<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama', 100);
            $table->string('no_ktp', 100);
            $table->string('tempat_lahir', 100);
            $table->date('tgl_lahir');
            $table->double('umur');
            $table->string('pekerjaan', 100);
            $table->string('pendidikan', 100);
            $table->string('nama_suami', 100);
            $table->string('no_ktp_suami', 100);
            $table->double('umur_suami', 100);
            $table->string('pekerjaan_suami', 100);
            $table->string('pendidikan_suami', 100);
            $table->string('alamat', 100);
            $table->string('alamat_domisili', 100);
            $table->string('rw', 100);
            $table->string('kecamatan', 100);
            $table->string('kabupaten', 100);
            $table->string('kota', 100);
            $table->string('no_tlp', 100);
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
        Schema::dropIfExists('pasiens');
    }
}
