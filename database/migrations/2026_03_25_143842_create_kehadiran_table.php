<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKehadiranTable extends Migration
{
    public function up()
    {
        Schema::create('kehadiran', function (Blueprint $table) {
            $table->id();

            $table->foreignId('absensi_id')
                  ->constrained('absensi')
                  ->onDelete('cascade');

            $table->foreignId('atlet_id')
                  ->constrained('atlet')
                  ->onDelete('cascade');

            $table->enum('status', ['hadir', 'tidak_hadir', 'izin']);

            $table->text('evaluasi_teknik')->nullable();
            $table->text('evaluasi_fisik')->nullable();
            $table->text('evaluasi_mental')->nullable();

            $table->timestamps();

            // 🔥 biar 1 atlet tidak dobel dalam 1 absensi
            $table->unique(['absensi_id', 'atlet_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('kehadiran');
    }
}