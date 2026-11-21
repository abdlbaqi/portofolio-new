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
        Schema::create('kategori_keahlian', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori'); // Frontend, Backend, Database, Cloud & DevOps, Desain, dll.
            $table->string('slug')->unique();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('keahlian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->nullable()->constrained('kategori_keahlian')->nullOnDelete();
            $table->string('nama_keahlian'); // Laravel, React, Vue, MySQL, TailwindCSS, dll.
            $table->unsignedTinyInteger('tingkat_persen')->default(80); // 1 - 100
            $table->string('level')->nullable(); // Pemula, Menengah, Mahir, Ahli
            $table->string('ikon')->nullable();
            $table->boolean('apakah_unggulan')->default(false);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keahlian');
        Schema::dropIfExists('kategori_keahlian');
    }
};
