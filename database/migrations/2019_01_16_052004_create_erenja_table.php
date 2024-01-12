<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErenjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erenja', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('idopd');
            $table->Integer('idprgrm');
            $table->Integer('kdkegunit');
            $table->Integer('idindikatorkeg');
            $table->year('periode');
            $table->bigInteger('triwulan1k')->nullable();
            $table->bigInteger('triwulan1')->nullable();
            $table->bigInteger('triwulan2k')->nullable();
            $table->bigInteger('triwulan2')->nullable();
            $table->bigInteger('triwulan3k')->nullable();
            $table->bigInteger('triwulan3')->nullable();
            $table->bigInteger('triwulan4k')->nullable();
            $table->bigInteger('triwulan4')->nullable();
            $table->string('pjawab', 100)->nullable();
            $table->text('ket')->nullable();
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
        Schema::dropIfExists('erenja');
    }
}
