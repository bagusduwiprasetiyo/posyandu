<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPasienColumnToKelahiranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelahiran', function (Blueprint $table) {
            $table->unsignedBigInteger('pasien_id')->nullable()->after('id');
            $table->foreign('pasien_id')->references('id')->on('pasien')->cascadeOnDelete();
            $table->unsignedBigInteger('kehamilan_id');
            $table->foreign('kehamilan_id')->references('id')->on('kehamilan')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelahiran', function (Blueprint $table) {
            //
        });
    }
}
