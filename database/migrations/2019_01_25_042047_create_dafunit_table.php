<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDafunitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dafunit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id');
            $table->integer('id_status');
            $table->integer('order_no')->nullable();
            $table->integer('kdlevel');
            $table->string('unitkey',10);
            $table->string('kdunit',20);
            $table->string('nm_unit',100);
            $table->string('type',2);
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
        Schema::dropIfExists('dafunit');
    }
}
