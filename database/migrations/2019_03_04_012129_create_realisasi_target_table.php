<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealisasiTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realisasi_target', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_target');
            $table->double('k5',15,2)->nullable();
            $table->double('k6',15,2)->nullable();
            $table->double('kt1',15,2)->nullable();
            $table->double('kt2',15,2)->nullable();
            $table->double('kt3',15,2)->nullable();
            $table->double('kt4',15,2)->nullable();
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
        Schema::dropIfExists('realisasi_target');
    }
}
