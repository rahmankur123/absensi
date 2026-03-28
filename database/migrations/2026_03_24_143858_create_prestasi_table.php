<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestasi', function (Blueprint $table) {
    $table->id();
    $table->foreignId('atlet_id')->constrained('atlet')->onDelete('cascade');

    $table->string('nama_kejuaraan');
    $table->string('tingkat'); // kab/kota/nasional
    $table->string('juara');
    $table->year('tahun');
    $table->string('bukti_prestasi')->nullable();
    $table->text('keterangan')->nullable();

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
        Schema::dropIfExists('prestasi');
    }
}
