<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasils', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kehamilan_id');
            $table->foreign('kehamilan_id')->references('id')->on('kehamilan')->cascadeOnDelete();
            $table->unsignedBigInteger('pasien_id');
            $table->foreign('pasien_id')->references('id')->on('pasien')->cascadeOnDelete();
            $table->float('jarak');
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
        Schema::dropIfExists('hasils');
    }
}
