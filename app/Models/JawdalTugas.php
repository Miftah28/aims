<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class JawdalTugas extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'petugas_id',
        'lokasi_id',
        'tanggal',
        'keterangan',
    ];
    public function petugas()
    {
        return $this->belongsTo('App\Models\Petugas');
    }
    public function lokasi()
    {
        return $this->belongsTo('App\Models\Lokasi');
    }
}
