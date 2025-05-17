<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengantinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengantins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pasien_id');
            $table->string('st_imun');
            $table->date('tgl_imun');
            $table->string('ikut_kelas');
            $table->double('berat');
            $table->double('tinggi');
            $table->string('lila');
            $table->string('kes_jiwa');
            $table->string('hiv');
            $table->string('kehamilan');
            $table->string('rwt_penyakit');
            $table->string('rwt_penyakit_klg');
            $table->string('kontrasepsi');
            $table->double('suhu');
            $table->string('nadi');
            $table->string('nafas');
            $table->string('tk_darah');
            $table->string('hb');
            $table->string('trombosit');
            $table->string('leukosit');
            $table->string('gol_darah');
            $table->string('rhesus');
            $table->string('gds');
            $table->string('thalasemia');
            $table->string('hepatitis_b');
            $table->string('hepatitis_c');
            $table->string('torch');
            $table->string('urin');
            $table->string('pakaian');
            $table->string('pakaian_dlm');
            $table->timestamps();
            
            $table->foreign('pasien_id')->references('id')->on('pasiens')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengantins');
    }
}
