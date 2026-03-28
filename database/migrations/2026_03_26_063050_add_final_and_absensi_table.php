<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFinalAndAbsensiTable extends Migration
{
    public function up()
    {
        // Tambah kolom bukti di kehadiran
        Schema::table('kehadiran', function (Blueprint $table) {
            if (!Schema::hasColumn('kehadiran', 'bukti')) {
                $table->string('bukti')->nullable();
            }
        });

        // Tambah kolom status di absensi
        Schema::table('absensi', function (Blueprint $table) {
            if (!Schema::hasColumn('absensi', 'status')) {
                $table->boolean('status')->default(true);
            }
        });
    }

    public function down()
    {
        // Hapus kolom bukti
        Schema::table('kehadiran', function (Blueprint $table) {
            if (Schema::hasColumn('kehadiran', 'bukti')) {
                $table->dropColumn('bukti');
            }
        });

        // Hapus kolom status
        Schema::table('absensi', function (Blueprint $table) {
            if (Schema::hasColumn('absensi', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
}