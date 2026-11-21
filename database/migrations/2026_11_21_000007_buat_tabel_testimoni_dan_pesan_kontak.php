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
        Schema::create('testimoni', function (Blueprint $table) {
            $table->id();
            $table->string('nama_klien');
            $table->string('perusahaan')->nullable();
            $table->string('jabatan')->nullable(); // Cth: CEO, Product Manager
            $table->string('foto_klien')->nullable();
            $table->text('isi_testimoni');
            $table->unsignedTinyInteger('rating')->default(5); // 1 - 5 bintang
            $table->boolean('apakah_ditampilkan')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('pesan_kontak', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengirim');
            $table->string('email_pengirim');
            $table->string('no_telepon')->nullable();
            $table->string('subjek');
            $table->text('isi_pesan');
            $table->boolean('apakah_sudah_dibaca')->default(false);
            $table->timestamp('dibaca_pada')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesan_kontak');
        Schema::dropIfExists('testimoni');
    }
};
