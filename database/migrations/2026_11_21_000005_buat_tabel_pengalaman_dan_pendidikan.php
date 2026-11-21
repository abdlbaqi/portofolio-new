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
        Schema::create('pengalaman_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('posisi'); // Web Developer, Backend Engineer, dll.
            $table->string('perusahaan');
            $table->string('tipe_pekerjaan')->nullable(); // Penuh Waktu, Paruh Waktu, Kontrak, Freelance, Magang
            $table->string('lokasi')->nullable(); // Jakarta / Remote
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->boolean('saat_ini_bekerja')->default(false);
            $table->text('deskripsi')->nullable(); // Tugas & pencapaian
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('pendidikan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_institusi'); // Nama Universitas / Sekolah
            $table->string('jurusan'); // Teknik Informatika, Sistem Informasi, dll.
            $table->string('gelar')->nullable(); // S.Kom, D3, dll.
            $table->string('nilai_akhir')->nullable(); // IPK / Nilai
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidikan');
        Schema::dropIfExists('pengalaman_kerja');
    }
};
