<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $table = 'testimoni';
    protected $guarded = ['id'];
    protected $casts = [
        'apakah_ditampilkan' => 'boolean',
    ];
}
