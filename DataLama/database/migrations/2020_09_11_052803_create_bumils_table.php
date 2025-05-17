<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBumilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bumils', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pasien_id');
            $table->string('status_gravida');
            $table->date('tgl_hpth');
            $table->date('tgl_htp');
            $table->double('ling_lengan');
            $table->double('tinggi');
            $table->string('peng_kontrasepsi');
            $table->string('riw_penyakit');
            $table->double('imt');
            $table->string('map');
            $table->string('rot');
            $table->string('riwayat_alergi');
            $table->string('hamil_ke');
            $table->string('jum_persalinan');
            $table->string('jum_keguguran');
            $table->string('jum_anak_hidup');
            $table->string('jum_lahir_mati');
            $table->string('jum_lahir_kur_bulan');
            $table->string('jarak_kehamilan');
            $table->string('buk_kia');
            $table->date('tgl_beri')->nullable();
            $table->string('penolong_persalinan');
            $table->string('cara_persalinan_terakhir');
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
        Schema::dropIfExists('bumils');
    }
}
