<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriKeahlian extends Model
{
    protected $table = 'kategori_keahlian';
    protected $guarded = ['id'];

    public function keahlian()
    {
        return $this->hasMany(Keahlian::class, 'kategori_id')->orderBy('urutan');
    }
}
