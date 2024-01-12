<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidangUrusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bidang_urusan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_urusan');
            $table->String('unit_key',10);
            $table->String('kdunit',10);
            $table->String('nm_burusan');
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
        Schema::dropIfExists('bidang_urusan');
    }
}
