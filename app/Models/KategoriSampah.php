<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSampah extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'gambar',
        'jenis_sampah',
        'poin_sampah',
        'berat_sampah',
    ];
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }
}
