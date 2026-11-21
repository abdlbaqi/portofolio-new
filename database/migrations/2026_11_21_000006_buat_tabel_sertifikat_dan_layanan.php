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
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sertifikat');
            $table->string('organisasi_penerbit'); // Cth: Dicoding, Coursera, Google, BNSP
            $table->date('tanggal_terbit');
            $table->date('tanggal_kadaluarsa')->nullable();
            $table->string('nomor_kredensial')->nullable();
            $table->string('url_kredensial')->nullable();
            $table->string('file_sertifikat')->nullable(); // PDF / scan
            $table->string('gambar_sampul')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('layanan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_layanan'); // Cth: Pembuatan Website, Desain UI/UX, Optimasi SEO
            $table->string('ikon')->nullable();
            $table->text('ringkasan')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->decimal('harga_mulai_dari', 15, 2)->nullable();
            $table->boolean('apakah_aktif')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan');
        Schema::dropIfExists('sertifikat');
    }
};
