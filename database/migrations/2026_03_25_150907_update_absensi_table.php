<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAbsensiTable extends Migration
{
    public function up()
    {
        Schema::table('absensi', function (Blueprint $table) {

            // 🔥 tambah kolom baru
            if (!Schema::hasColumn('absensi', 'jadwal_id')) {
                $table->foreignId('jadwal_id')
                      ->nullable()
                      ->after('id')
                      ->constrained('jadwal')
                      ->onDelete('cascade');
            }

            if (!Schema::hasColumn('absensi', 'tanggal')) {
                $table->date('tanggal')->nullable()->after('jadwal_id');
            }

            // 🔥 hapus kolom lama (kalau ada)
            if (Schema::hasColumn('absensi', 'atlet_id')) {
                $table->dropColumn('atlet_id');
            }

            if (Schema::hasColumn('absensi', 'status')) {
                $table->dropColumn('status');
            }

            if (Schema::hasColumn('absensi', 'evaluasi_teknik')) {
                $table->dropColumn('evaluasi_teknik');
                $table->dropColumn('evaluasi_fisik');
                $table->dropColumn('evaluasi_mental');
            }
        });
    }

    public function down()
    {
        Schema::table('absensi', function (Blueprint $table) {

            // rollback sederhana (opsional)
            $table->dropForeign(['jadwal_id']);
            $table->dropColumn(['jadwal_id', 'tanggal']);
        });
    }
}