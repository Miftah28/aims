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
        Schema::create('tukar_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_sampah_id');
            $table->unsignedBigInteger('petugas_id');
            $table->unsignedBigInteger('nasabah_id');
            $table->dateTime('tanggal');
            $table->string('status');
            $table->integer('tambah_poin')->nullable();
            $table->integer('kurang_poin')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('kategori_sampah_id')->references('id')->on('kategori_sampahs')->onDelete('cascade');
            $table->foreign('nasabah_id')->references('id')->on('nasabahs')->onDelete('cascade');
            $table->foreign('petugas_id')->references('id')->on('petugas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tukar_points');
    }
};
