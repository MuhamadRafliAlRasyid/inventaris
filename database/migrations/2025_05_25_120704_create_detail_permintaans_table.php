<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_permintaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permintaan_id');
            $table->unsignedBigInteger('barang_id');
            $table->integer('jumlah');
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('permintaan_id')
                ->references('id')->on('permintaan') // 🟢 Sesuai nama tabel sebenarnya
                ->onDelete('cascade');

            $table->foreign('barang_id')
                ->references('id')->on('barang')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_permintaan');
    }
};
