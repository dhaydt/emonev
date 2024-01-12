<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRpjmdProgIndikatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rpjmd_prog_indikator', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idprgrm');
            $table->integer('id_instansi');
            $table->string('unitkey',10);
            $table->string('indikator');
            $table->string('satuan',50);
            $table->string('t1');
            $table->string('t2');
            $table->string('t3');
            $table->string('t4');
            $table->string('t5');
            $table->string('t6');
            $table->string('rt1');
            $table->string('rt2');
            $table->string('rt3');
            $table->string('rt4');
            $table->string('rt5');
            $table->string('rt6');
            $table->string('pe1');
            $table->string('pe2');
            $table->string('pe3');
            $table->string('pe4');
            $table->string('pe5');
            $table->string('pe6');
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
        Schema::dropIfExists('rpjmd_prog_indikator');
    }
}
