<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealisasiTprogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realisasi_tprog', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_ind_prog');
            $table->integer('ket_prog')->nullable();
            $table->double('p_re',15,2)->nullable();
            $table->double('p_t1',15,2)->nullable();
            $table->double('p_t2',15,2)->nullable();
            $table->double('p_t3',15,2)->nullable();
            $table->double('p_t4',15,2)->nullable();
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
        Schema::dropIfExists('realisasi_tprog');
    }
}
