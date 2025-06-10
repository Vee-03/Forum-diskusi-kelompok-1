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
        Schema::create('diskusi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('forum_id');  // relasi ke forum
            $table->unsignedBigInteger('user_id'); // ID user yang membuat diskusi
            $table->string('judul');
            $table->text('isi')->nullable();
            $table->string('foto_diskusi')->nullable(); // Opsional
            $table->timestamps();

            // Relasi ke users
            $table->foreign('forum_id')->references('id')->on('forum')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diskusi');
    }
};
