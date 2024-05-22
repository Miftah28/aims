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
            $table->unsignedBigInteger('point_id')->nullable();
            // $table->unsignedBigInteger('kategori_sampah_id')->nullable();
            $table->unsignedBigInteger('sampah_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('petugas_id')->nullable();
            $table->unsignedBigInteger('lokasi_id')->nullable();
            $table->unsignedBigInteger('nasabah_id');
            $table->dateTime('tanggal');
            $table->string('status');
            $table->string('instansi');
            $table->integer('tambah_poin')->nullable();
            $table->integer('kurang_poin')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('sampah_id')->references('id')->on('sampahs')->onDelete('cascade');
            // $table->foreign('kategori_sampah_id')->references('id')->on('kategori_sampahs')->onDelete('cascade');
            $table->foreign('point_id')->references('id')->on('points')->onDelete('cascade');
            $table->foreign('nasabah_id')->references('id')->on('nasabahs')->onDelete('cascade');
            $table->foreign('petugas_id')->references('id')->on('petugas')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('lokasi_id')->references('id')->on('lokasis')->onDelete('cascade');
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
