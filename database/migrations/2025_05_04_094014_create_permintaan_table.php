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
            $table->unsignedBigInteger('barang_id'); // Define the barang_id column
            $table->foreign('barang_id') // Define the foreign key constraint
                ->references('id') // Reference the id column on the barang table
                ->on('barang') // Specify the barang table
                ->onDelete('restrict') // Define the delete behavior
                ->onUpdate('cascade'); // Define the update behavior
            $table->integer('jumlah');
            $table->timestamps();
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
