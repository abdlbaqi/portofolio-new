<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    protected $table = 'proyek';
    protected $guarded = [];
    protected $casts = [
        'teknologi' => 'array',
        'apakah_unggulan' => 'boolean',
        'tanggal_selesai' => 'date',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriProyek::class, 'kategori_id');
    }

    public function galeri()
    {
        return $this->hasMany(GambarProyek::class, 'proyek_id')->orderBy('urutan');
    }
}
