<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRenjaIndikatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renja_indikator', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_renja');
            $table->string('kdjkk',2);
            $table->integer('kdkegunit');
            $table->integer('kdtahap');
            $table->string('unitkey',10);
            $table->text('tolokur');
            $table->text('sat');
            $table->text('target');
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
        Schema::dropIfExists('renja_indikator');
    }
}
