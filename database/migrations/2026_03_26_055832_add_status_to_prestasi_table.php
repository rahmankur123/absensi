<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToPrestasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('prestasi', function (Blueprint $table) {
        $table->enum('status', ['pending','disetujui','ditolak'])
              ->default('pending');
    });
}

public function down()
{
    Schema::table('prestasi', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}
}
