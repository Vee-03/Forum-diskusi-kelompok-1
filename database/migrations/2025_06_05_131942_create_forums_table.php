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
        Schema::create('forum', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('foto_forum')->nullable();
            $table->integer('jumlah_diskusi')->default(0);
            $table->integer('jumlah_anggota')->default(0);
            $table->timestamp('terakhir_aktif')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum');
    }
};
