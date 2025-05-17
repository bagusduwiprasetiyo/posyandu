<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPasienidFieldsToKunjunganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kunjungan', function (Blueprint $table) {
            $table->unsignedBigInteger('pasien_id')->nullable()->after('id');
            $table->foreign('pasien_id')->references('id')->on('pasien')->cascadeOnDelete();
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
