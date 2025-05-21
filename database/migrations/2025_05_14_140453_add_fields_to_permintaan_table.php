<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('permintaan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user')->after('barang_id');
            $table->unsignedBigInteger('mengetahui')->nullable()->after('id_user');
            $table->unsignedBigInteger('approval')->nullable()->after('mengetahui');
            $table->text('keterangan')->nullable()->after('jumlah');

            // Foreign keys
            $table->foreign('id_user')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('mengetahui')->references('id')->on('users')->onDelete('set null');
            $table->foreign('approval')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('permintaan', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropForeign(['mengetahui']);
            $table->dropForeign(['approval']);
            $table->dropColumn(['id_user', 'mengetahui', 'approval', 'keterangan']);
        });
    }
};
