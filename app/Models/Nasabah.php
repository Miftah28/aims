<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'alamat',
        'no_hp',
        'kode_pengguna',
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function point()
    {
        return $this->hasOne('App\Models\PoinNasabah');
    }
}
