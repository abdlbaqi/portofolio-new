<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriProyek extends Model
{
    protected $table = 'kategori_proyek';
    protected $guarded = ['id'];

    public function proyek()
    {
        return $this->hasMany(Proyek::class, 'kategori_id');
    }
}
