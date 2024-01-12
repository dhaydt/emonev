<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realisasi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_renja');
            $table->double('rp5',15,0)->nullable();
            $table->double('rp6',15,0)->nullable();
            $table->double('rpt1',15,0)->nullable();
            $table->double('rpt2',15,0)->nullable();
            $table->double('rpt3',15,0)->nullable();
            $table->double('rpt4',15,0)->nullable();
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
        Schema::dropIfExists('realisasi');
    }
}
