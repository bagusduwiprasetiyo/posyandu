<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResikoknnFieldsToKunjunganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kunjungan', function (Blueprint $table) {
            $table->float('jarak_knn')->after('resiko')->nullable();
            $table->char('resiko_knn')->after('resiko')->nullable();
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
