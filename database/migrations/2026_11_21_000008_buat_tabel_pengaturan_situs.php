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
        Schema::create('pengaturan_situs', function (Blueprint $table) {
            $table->id();
            $table->string('kunci')->unique(); // meta_judul, meta_deskripsi, favicon, logo, footer_teks, google_analytics, dll.
            $table->longText('nilai')->nullable();
            $table->string('tipe')->default('teks'); // teks, textarea, gambar, berkas, boolean
            $table->string('grup')->default('umum'); // umum, seo, kontak, integrasi
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan_situs');
    }
};
