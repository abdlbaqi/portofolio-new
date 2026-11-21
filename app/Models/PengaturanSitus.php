<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanSitus extends Model
{
    protected $table = 'pengaturan_situs';
    protected $guarded = ['id'];

    public static function ambil($kunci, $default = null)
    {
        $setting = static::where('kunci', $kunci)->first();
        return $setting ? $setting->nilai : $default;
    }
}
