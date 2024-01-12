<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRenstraKegTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renstra_keg', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idprgrm');
            $table->string('kdperspektif',10);
            $table->string('nmkegunit');
            $table->string('levelkeg',1);
            $table->string('type',1);
            $table->string('kode',2);
            $table->integer('id_status');
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
        Schema::dropIfExists('renstra_keg');
    }
}
