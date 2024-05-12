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
        Schema::create('jadwal_tugas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lokasi_id');
            $table->unsignedBigInteger('admin_id');
            $table->dateTime('mulai_penjemputan');
            $table->dateTime('selesai_penjemputan');
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('lokasi_id')->references('id')->on('lokasis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_tugas');
    }
};
