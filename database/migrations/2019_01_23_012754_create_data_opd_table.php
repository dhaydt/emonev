<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataOpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_opd', function (Blueprint $table) {
            $table->increments('id');
            $table->String('unit_key',10);
            $table->String('kdunit',15);
            $table->integer('kdlevel');
            $table->String('tipe',2);
            $table->String('nm_instansi',150);
            $table->String('nip',80)->nullable();
            $table->String('kepala',70)->nullable();
            $table->String('singkatan',30)->nullable();
            $table->String('akrounit',30)->nullable();
            $table->String('telp',20)->nullable();
            $table->text('alamat')->nullable();
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
        Schema::dropIfExists('data_opd');
    }
}
