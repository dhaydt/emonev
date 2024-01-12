<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrusanOpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urusan_opd', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('id_instansi');
            $table->text('arr_urusan');
            $table->year('th_awal');
            $table->year('th_akhir');
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
        Schema::dropIfExists('urusan_opd');
    }
}
