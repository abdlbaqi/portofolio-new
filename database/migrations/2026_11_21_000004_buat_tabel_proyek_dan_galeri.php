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
        Schema::create('kategori_proyek', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori'); // Web Application, Mobile App, UI/UX Design, REST API, dll.
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('proyek', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->nullable()->constrained('kategori_proyek')->nullOnDelete();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('ringkasan')->nullable();
            $table->longText('deskripsi');
            $table->string('gambar_sampul')->nullable();
            $table->string('url_demo')->nullable();
            $table->string('url_repositori')->nullable(); // GitHub / GitLab
            $table->string('klien')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->json('teknologi')->nullable(); // Array string teknologi yang digunakan: ["Laravel", "Vue.js", "Tailwind"]
            $table->boolean('apakah_unggulan')->default(false); // Ditampilkan di beranda
            $table->enum('status', ['draft', 'dipublikasi', 'diarsipkan'])->default('dipublikasi');
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('gambar_proyek', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyek_id')->constrained('proyek')->cascadeOnDelete();
            $table->string('path_gambar');
            $table->string('keterangan')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gambar_proyek');
        Schema::dropIfExists('proyek');
        Schema::dropIfExists('kategori_proyek');
    }
};
