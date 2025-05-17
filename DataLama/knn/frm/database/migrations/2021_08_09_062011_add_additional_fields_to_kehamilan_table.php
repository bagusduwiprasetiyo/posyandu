<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToKehamilanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kehamilan', function (Blueprint $table) {
            $table->integer('skor_awal')->after('buku_kia')->default(2);
            $table->integer('terlalu_muda_hamil')->default(0);
            $table->integer('terlalu_tua_hamil')->default(0);
            $table->integer('lama_hamil_lagi')->comment('>= 10 tahun')->default(0)->after('lambat_hamil_pertama');
            $table->integer('cepat_hamil_lagi')->comment('< 2 Tahun')->default(0);
            $table->integer('banyak_anak')->comment('4 / lebih')->default(0);
            $table->integer('umur_terlalu_tua')->comment('>= 35 Tahun')->default(0);
            $table->integer('terlalu_pendek')->comment('<= 145>')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kehamilan', function (Blueprint $table) {
            //
        });
    }
}
