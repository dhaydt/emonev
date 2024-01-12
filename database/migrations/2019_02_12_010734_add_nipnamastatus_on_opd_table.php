<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNipnamastatusOnOpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opd', function (Blueprint $table) {
        $table->text('nip')->nullable()->after('remember_token');
        $table->string('nm_pegawai',50)->nullable()->after('nip');
        $table->string('status',2)->nullable()->after('nm_pegawai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
