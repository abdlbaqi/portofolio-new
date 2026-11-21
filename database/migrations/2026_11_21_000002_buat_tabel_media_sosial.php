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
        Schema::create('media_sosial', function (Blueprint $table) {
            $table->id();
            $table->string('nama_platform'); // GitHub, LinkedIn, Instagram, X/Twitter, YouTube, dll.
            $table->string('url');
            $table->string('ikon')->nullable(); // Class ikon (cth: fab fa-github atau lucide:github)
            $table->integer('urutan')->default(0);
            $table->boolean('apakah_aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_sosial');
    }
};
