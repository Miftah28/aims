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
        Schema::create('sampahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lokasi_id')->nullable();
            $table->unsignedBigInteger('kategori_sampah_id');
            $table->unsignedBigInteger('petugas_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('nasabah_id')->nullable();
            $table->integer('pemasukan_sampah');
            $table->dateTime('tanggal');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('kategori_sampah_id')->references('id')->on('kategori_sampahs')->onDelete('cascade');
            $table->foreign('lokasi_id')->references('id')->on('lokasis')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('petugas_id')->references('id')->on('petugas')->onDelete('cascade');
            $table->foreign('nasabah_id')->references('id')->on('nasabahs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sampahs');
    }
};
