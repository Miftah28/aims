<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class PetugasJemput extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'jadwal_tugas_id',
        'petugas_id',
    ];
    public function jadwalTugas()
    {
        return $this->belongsTo('App\Models\JadwalTugas');
    }
    public function petugas()
    {
        return $this->belongsTo('App\Models\Petugas');
    }
}
