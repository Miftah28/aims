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
        Schema::create('petugas_jemputs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_tugas_id');
            $table->unsignedBigInteger('petugas_id');
            $table->timestamps();

            $table->foreign('petugas_id')->references('id')->on('petugas')->onDelete('cascade');
            $table->foreign('jadwal_tugas_id')->references('id')->on('jadwal_tugas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petugas_jemputs');
    }
};
