<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateAbsensiTable extends Migration
{
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('jadwal_id')
                  ->constrained('jadwal')
                  ->onDelete('cascade');

            $table->date('tanggal');

            $table->timestamps();

            // 🔥 biar tidak double absensi di hari & jadwal yang sama
            $table->unique(['jadwal_id', 'tanggal']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('absensi');
    }
}
