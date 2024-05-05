<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoinNasabah extends Model
{
    use HasFactory;
    protected $fillable = [
        'nasabah_id',
        'total',
        'tanggal',
    ];
    public function nasabah()
    {
        return $this->belongsTo('App\Models\Nasabah');
    }
}
