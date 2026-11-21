<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GambarProyek extends Model
{
    protected $table = 'gambar_proyek';
    protected $guarded = ['id'];

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id');
    }
}
