<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRenjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renja', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_instansi');
            $table->year('periode');
            $table->string('unitkey',10);
            $table->integer('induk_key');
            $table->string('urusan_key',11);
            $table->integer('idmslh');
            $table->integer('kdkegunit');
            $table->string('nm_kegunit_awal');
            $table->string('nm_kegunit_akhir');
            $table->string('tanda_lokasi',1);
            $table->integer('id_prioritas');
            $table->integer('id_sasaran_prioritas');
            $table->integer('id_prioritas_nasional');
            $table->integer('id_jenis_belanja');
            $table->integer('idprgrm');
            $table->integer('noprior');
            $table->integer('id_renstra_detail');
            $table->datetime('tglawal')->nullable();
            $table->datetime('tglakhir')->nullable();
            $table->double('belanja_p_now');
            $table->double('belanja_bj_now');
            $table->double('belanja_m_now');
            $table->double('belanja_p_after');
            $table->double('belanja_bj_after');
            $table->double('belanja_m_after');
            $table->text('lokasi');
            $table->double('jumlahmin1');
            $table->double('pagu');
            $table->double('pagu_after');
            $table->string('target_before');
            $table->string('target_after');
            $table->integer('sumber_dana');
            $table->double('jumlahpls1');
            $table->text('alasan_bappeda');
            $table->text('alasan_bidang_evaluasi');
            $table->integer('kdstatus_urgency')->nullable;
            $table->text('keterangan_sumber_dana');
            $table->string('tags',2);
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
        Schema::dropIfExists('renja');
    }
}
