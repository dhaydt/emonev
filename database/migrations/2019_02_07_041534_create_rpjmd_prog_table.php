<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRpjmdProgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rpjmd_prog', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idprgrm');
            $table->integer('id_indikator_rpjmd');
            $table->year('tahun_awal_rpjmd');
            $table->year('tahun_akhir_rpjmd');
            $table->string('unitkey');
            $table->text('nmprgrm');
            $table->text('programindikator');
            $table->text('id_instansi');
            $table->string('nuprgrm',10);
            $table->integer('id_status');
            $table->string('prioritas',2);
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
        Schema::dropIfExists('rpjmd_prog');
    }
}
