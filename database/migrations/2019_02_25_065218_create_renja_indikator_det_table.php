<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRenjaIndikatorDetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renja_indikator_det', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kegindikator');
            $table->text('tolokur_sumber');
            $table->text('target_sumber');
            $table->text('tolokur_det');
            $table->text('sat_det');
            $table->text('target_det');
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
        Schema::dropIfExists('renja_indikator_det');
    }
}
