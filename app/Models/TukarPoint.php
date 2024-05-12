<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TukarPoint extends Model
{
    use HasFactory;
    protected $fillable = [
        'kategori_sampah_id',
        'petugas_id',
        'nasabah_id',
        'lokasi_id',
        'tanggal',
        'status',
        'tammbah_poin',
        'kurang_poin',
    ];
    public function ketegoriSampah()
    {
        return $this->belongsTo('App\Models\KetegoriSampah');
    }
    public function petugas()
    {
        return $this->belongsTo('App\Models\Petugas');
    }
    public function nasabah()
    {
        return $this->belongsTo('App\Models\Nasabah');
    }
    public function lokasi()
    {
        return $this->belongsTo('App\Models\Lokasi');
    }
}