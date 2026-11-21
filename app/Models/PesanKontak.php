<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanKontak extends Model
{
    protected $table = 'pesan_kontak';
    protected $guarded = [];
    protected $casts = [
        'apakah_sudah_dibaca' => 'boolean',
        'dibaca_pada' => 'datetime',
    ];
}
