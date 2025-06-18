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
        Schema::create('permintaan', function (Blueprint $table) {
            $table->id();

            // User yang membuat permintaan
            $table->unsignedBigInteger('user_id');

            // User yang mengetahui dan menyetujui (nullable)
            $table->unsignedBigInteger('mengetahui')->nullable();
            $table->unsignedBigInteger('approval')->nullable();
            $table->dateTime('approval_time')->nullable();
            $table->string('satuan')->nullable();

            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('mengetahui')->references('id')->on('users')->onDelete('set null');
            $table->foreign('approval')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan');
    }
};
