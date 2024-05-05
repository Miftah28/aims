<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSampah extends Model
{
    use HasFactory;
    protected $fillable = [
        'jenis_sampah',
        'poin_sampah',
        'berat_sampah',
    ];
}
