<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateJamDiJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('jadwal', function (Blueprint $table) {
        $table->time('jam_mulai')->after('hari');
        $table->time('jam_selesai')->after('jam_mulai');

        $table->dropColumn('jam');
    });
}

public function down()
{
    Schema::table('jadwal', function (Blueprint $table) {
        $table->time('jam')->nullable();

        $table->dropColumn(['jam_mulai', 'jam_selesai']);
    });
}
}
