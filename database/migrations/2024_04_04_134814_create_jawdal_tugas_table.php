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
        Schema::create('jawdal_tugas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('petugas_id');
            $table->unsignedBigInteger('lokasi_id');
            $table->dateTime('tanggal');
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('petugas_id')->references('id')->on('petugas')->onDelete('cascade');
            $table->foreign('lokasi_id')->references('id')->on('lokasis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawdal_tugas');
    }
};
