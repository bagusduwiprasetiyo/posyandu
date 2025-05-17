<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKehamilanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kehamilan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasien_id');
            $table->foreign('pasien_id')->references('id')->on('pasien')->cascadeOnDelete();
            $table->integer('usia_ibu')->comment('Usia ibu saat hamil');
            $table->integer('usia_kehamilan')->comment('Usia kehamialan dalam minggu');
            $table->integer('hamil_ke');
            $table->integer('berat_badan');
            $table->float('tinggi_badan');
            $table->float('lila')->comment('lingkar lengan atas');
            $table->float('hb');
            $table->float('tesni_a')->comment('tensi atas');
            $table->float('tesni_b')->comment('tensi bawah');
            $table->float('jarak_hamil');
            $table->char('imunisasi', 5);
            $table->date('tgl_imunisasi');
            $table->enum('buku_kia', ['Ya', 'Tidak'])->default('Ya');
            $table->integer('lambat_hamil_pertama')->default(0)->comment('Lambat hamil ');
            $table->integer('gagal_hamil')->default(0)->comment('Pernah gagal hamil ');
            $table->integer('lahir_vakum')->default(0)->comment('Pernah melahirkan dengan vakum');
            $table->integer('lahir_dirogoh')->default(0)->comment('Pernah melahirkan dengan uri dirogoh ');
            $table->integer('lahir_transfusi')->default(0)->comment('Pernah melahirkan dengan transfusi ');
            $table->integer('penyakit_kurang_darah')->default(0)->comment('penyakit ibu hamil kurang darah');
            $table->integer('penyakit_malaria')->default(0)->comment('penyakit ibu hamil malaria');
            $table->integer('penyakit_tbc')->default(0)->comment('penyakit ibu hamil tbc');
            $table->integer('penyakit_jantung')->default(0)->comment('penyakit ibu hamil payah jantung');
            $table->integer('penyakit_kencing_manis')->default(0)->comment('penyakit ibu hamil kencing manis');
            $table->integer('penyakit_pms')->default(0)->comment('penyakit ibu hamil PMS');
            $table->integer('hamil_kembar')->default(0);
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
        Schema::dropIfExists('kehamilan');
    }
}
