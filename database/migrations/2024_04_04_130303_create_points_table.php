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
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            // $table->unsignedBigInteger('kategori_sampah_id');
            $table->integer('jumlah_poin');
            $table->integer('jumlah_saldo');
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('kategori_sampah_id')->references('id')->on('kategori_sampahs')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('points');
    }
};
