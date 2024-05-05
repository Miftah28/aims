<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    use HasFactory;
    protected $fillable = [
        'lokasi_id',
        'petugas_id',
        'nasabah_id',
        'pemasukan_sampah',
        'tanggal',
    ];
    public function lokasi()
    {
        return $this->belongsTo('App\Models\Lokasi');
    }
    public function petugas()
    {
        return $this->belongsTo('App\Models\Petugas');
    }
    public function nasabah()
    {
        return $this->belongsTo('App\Models\Nasabah');
    }
}
