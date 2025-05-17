<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelahiranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelahiran', function (Blueprint $table) {
            $table->id();
            $table->enum('penolong', ['Nakes', 'Dukun'])->default('Nakes');
            $table->enum('jk', ['Laki - Laki', 'Perempuan'])->default('Perempuan');
            $table->enum('hidup_mati', ['Hidup', 'Mati'])->default('Hidup');
            $table->float('berat')->nullable();
            $table->string('nifas_1')->nullable();
            $table->string('nifas_2')->nullable();
            $table->string('nifas_3')->nullable();
            $table->string('catatan')->nullable();
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
        Schema::dropIfExists('kelahiran');
    }
}
