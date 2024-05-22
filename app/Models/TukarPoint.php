<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TukarPoint extends Model
{
    use HasFactory;
    protected $fillable = [
        'point_id',
        // 'kategori_sampah_id',
        'sampah_id',
        'petugas_id',
        'nasabah_id',
        'lokasi_id',
        'admin_id',
        'tanggal',
        'status',
        'instansi',
        'tambah_poin',
        'kurang_poin',
    ];
    public function points()
    {
        return $this->belongsTo('App\Models\Point');
    }
    public function sampah()
    {
        return $this->belongsTo('App\Models\Sampah');
    }
    // public function kategorisampah()
    // {
    //     return $this->belongsTo('App\Models\KategoriSampah');
    // }
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
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }
}
