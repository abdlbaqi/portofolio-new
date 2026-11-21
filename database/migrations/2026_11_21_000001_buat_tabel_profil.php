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
        Schema::create('profil', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('panggilan')->nullable();
            $table->string('jabatan'); // Contoh: Full-Stack Web Developer
            $table->string('slogan')->nullable(); // Tagline singkat
            $table->text('ringkasan_tentang'); // Bio singkat di hero section
            $table->longText('deskripsi_lengkap')->nullable(); // Tentang saya lengkap
            $table->string('foto_profil')->nullable();
            $table->string('avatar')->nullable();
            $table->string('file_cv')->nullable(); // Dokumen CV PDF
            $table->string('email');
            $table->string('no_telepon')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->string('negara')->default('Indonesia');
            $table->string('status_pekerjaan')->default('Tersedia untuk Pekerjaan / Freelance');
            $table->unsignedInteger('tahun_pengalaman')->default(0);
            $table->unsignedInteger('total_proyek_selesai')->default(0);
            $table->unsignedInteger('total_klien_puas')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil');
    }
};
