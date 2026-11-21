-- ========================================================
-- SKEMA DATABASE WEBSITE PORTOFOLIO & CMS (BAHASA INDONESIA)
-- ========================================================

-- 1. Tabel Profil & Identitas Pribadi
CREATE TABLE IF NOT EXISTS `profil` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nama_lengkap` VARCHAR(255) NOT NULL,
  `panggilan` VARCHAR(100) NULL,
  `jabatan` VARCHAR(255) NOT NULL COMMENT 'Contoh: Full-Stack Web Developer',
  `slogan` VARCHAR(255) NULL COMMENT 'Tagline pendek',
  `ringkasan_tentang` TEXT NOT NULL COMMENT 'Bio singkat di hero / beranda',
  `deskripsi_lengkap` LONGTEXT NULL COMMENT 'Bio lengkap di halaman tentang',
  `foto_profil` VARCHAR(255) NULL,
  `avatar` VARCHAR(255) NULL,
  `file_cv` VARCHAR(255) NULL COMMENT 'Path file CV / Resume (PDF)',
  `email` VARCHAR(255) NOT NULL,
  `no_telepon` VARCHAR(50) NULL,
  `alamat` VARCHAR(255) NULL,
  `kota` VARCHAR(100) NULL,
  `negara` VARCHAR(100) NOT NULL DEFAULT 'Indonesia',
  `status_pekerjaan` VARCHAR(150) NOT NULL DEFAULT 'Tersedia untuk Pekerjaan / Freelance',
  `tahun_pengalaman` INT UNSIGNED NOT NULL DEFAULT 0,
  `total_proyek_selesai` INT UNSIGNED NOT NULL DEFAULT 0,
  `total_klien_puas` INT UNSIGNED NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Tabel Media Sosial
CREATE TABLE IF NOT EXISTS `media_sosial` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nama_platform` VARCHAR(100) NOT NULL COMMENT 'GitHub, LinkedIn, Instagram, dll.',
  `url` VARCHAR(255) NOT NULL,
  `ikon` VARCHAR(100) NULL COMMENT 'Class ikon atau SVG nama',
  `urutan` INT NOT NULL DEFAULT 0,
  `apakah_aktif` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Tabel Kategori Keahlian (Skills Category)
CREATE TABLE IF NOT EXISTS `kategori_keahlian` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nama_kategori` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(120) NOT NULL UNIQUE,
  `urutan` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Tabel Keahlian (Skills)
CREATE TABLE IF NOT EXISTS `keahlian` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `kategori_id` BIGINT UNSIGNED NULL,
  `nama_keahlian` VARCHAR(100) NOT NULL,
  `tingkat_persen` TINYINT UNSIGNED NOT NULL DEFAULT 80 COMMENT 'Persentase keahlian 1-100',
  `level` VARCHAR(50) NULL COMMENT 'Pemula, Menengah, Mahir, Ahli',
  `ikon` VARCHAR(255) NULL,
  `apakah_unggulan` TINYINT(1) NOT NULL DEFAULT 0,
  `urutan` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT `fk_keahlian_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_keahlian` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Tabel Kategori Proyek
CREATE TABLE IF NOT EXISTS `kategori_proyek` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nama_kategori` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(120) NOT NULL UNIQUE,
  `deskripsi` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Tabel Proyek / Portofolio
CREATE TABLE IF NOT EXISTS `proyek` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `kategori_id` BIGINT UNSIGNED NULL,
  `judul` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `ringkasan` TEXT NULL,
  `deskripsi` LONGTEXT NOT NULL,
  `gambar_sampul` VARCHAR(255) NULL,
  `url_demo` VARCHAR(255) NULL,
  `url_repositori` VARCHAR(255) NULL,
  `klien` VARCHAR(255) NULL,
  `tanggal_selesai` DATE NULL,
  `teknologi` JSON NULL COMMENT 'Array JSON nama stack teknologi yang digunakan',
  `apakah_unggulan` TINYINT(1) NOT NULL DEFAULT 0,
  `status` ENUM('draft', 'dipublikasi', 'diarsipkan') NOT NULL DEFAULT 'dipublikasi',
  `urutan` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT `fk_proyek_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_proyek` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. Tabel Gambar / Galeri Proyek
CREATE TABLE IF NOT EXISTS `gambar_proyek` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `proyek_id` BIGINT UNSIGNED NOT NULL,
  `path_gambar` VARCHAR(255) NOT NULL,
  `keterangan` VARCHAR(255) NULL,
  `urutan` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT `fk_gambar_proyek` FOREIGN KEY (`proyek_id`) REFERENCES `proyek` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. Tabel Pengalaman Kerja
CREATE TABLE IF NOT EXISTS `pengalaman_kerja` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `posisi` VARCHAR(255) NOT NULL,
  `perusahaan` VARCHAR(255) NOT NULL,
  `tipe_pekerjaan` VARCHAR(100) NULL COMMENT 'Penuh Waktu, Paruh Waktu, Freelance, Kontrak, Magang',
  `lokasi` VARCHAR(150) NULL,
  `tanggal_mulai` DATE NOT NULL,
  `tanggal_selesai` DATE NULL,
  `saat_ini_bekerja` TINYINT(1) NOT NULL DEFAULT 0,
  `deskripsi` TEXT NULL,
  `urutan` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 9. Tabel Pendidikan
CREATE TABLE IF NOT EXISTS `pendidikan` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nama_institusi` VARCHAR(255) NOT NULL,
  `jurusan` VARCHAR(255) NOT NULL,
  `gelar` VARCHAR(100) NULL,
  `nilai_akhir` VARCHAR(50) NULL COMMENT 'IPK atau Nilai kelulusan',
  `tanggal_mulai` DATE NOT NULL,
  `tanggal_selesai` DATE NULL,
  `deskripsi` TEXT NULL,
  `urutan` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 10. Tabel Sertifikat & Penghargaan
CREATE TABLE IF NOT EXISTS `sertifikat` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nama_sertifikat` VARCHAR(255) NOT NULL,
  `organisasi_penerbit` VARCHAR(255) NOT NULL,
  `tanggal_terbit` DATE NOT NULL,
  `tanggal_kadaluarsa` DATE NULL,
  `nomor_kredensial` VARCHAR(150) NULL,
  `url_kredensial` VARCHAR(255) NULL,
  `file_sertifikat` VARCHAR(255) NULL,
  `gambar_sampul` VARCHAR(255) NULL,
  `urutan` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 11. Tabel Layanan / Jasa
CREATE TABLE IF NOT EXISTS `layanan` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nama_layanan` VARCHAR(255) NOT NULL,
  `ikon` VARCHAR(100) NULL,
  `ringkasan` TEXT NULL,
  `deskripsi` LONGTEXT NULL,
  `harga_mulai_dari` DECIMAL(15, 2) NULL,
  `apakah_aktif` TINYINT(1) NOT NULL DEFAULT 1,
  `urutan` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 12. Tabel Testimoni Klien
CREATE TABLE IF NOT EXISTS `testimoni` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nama_klien` VARCHAR(255) NOT NULL,
  `perusahaan` VARCHAR(255) NULL,
  `jabatan` VARCHAR(150) NULL,
  `foto_klien` VARCHAR(255) NULL,
  `isi_testimoni` TEXT NOT NULL,
  `rating` TINYINT UNSIGNED NOT NULL DEFAULT 5,
  `apakah_ditampilkan` TINYINT(1) NOT NULL DEFAULT 1,
  `urutan` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 13. Tabel Pesan Masuk / Kontak
CREATE TABLE IF NOT EXISTS `pesan_kontak` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nama_pengirim` VARCHAR(255) NOT NULL,
  `email_pengirim` VARCHAR(255) NOT NULL,
  `no_telepon` VARCHAR(50) NULL,
  `subjek` VARCHAR(255) NOT NULL,
  `isi_pesan` TEXT NOT NULL,
  `apakah_sudah_dibaca` TINYINT(1) NOT NULL DEFAULT 0,
  `dibaca_pada` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 14. Tabel Pengaturan Situs & SEO
CREATE TABLE IF NOT EXISTS `pengaturan_situs` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `kunci` VARCHAR(100) NOT NULL UNIQUE,
  `nilai` LONGTEXT NULL,
  `tipe` VARCHAR(50) NOT NULL DEFAULT 'teks',
  `grup` VARCHAR(50) NOT NULL DEFAULT 'umum',
  `keterangan` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
