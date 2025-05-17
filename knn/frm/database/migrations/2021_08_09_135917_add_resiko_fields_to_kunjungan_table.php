<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResikoFieldsToKunjunganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kunjungan', function (Blueprint $table) {
            $table->integer('skor_akhir')->after('peb')->default(2)->nullable()->comment('jumlah skor');
            $table->char('resiko', 4)->after('peb')->nullable()->comment('Deteksi Resiko Awal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kunjungan', function (Blueprint $table) {
            //
        });
    }
}
