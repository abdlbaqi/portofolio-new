<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keahlian extends Model
{
    protected $table = 'keahlian';
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(KategoriKeahlian::class, 'kategori_id');
    }
}
