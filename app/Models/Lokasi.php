<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'tempat',
        'koordinat',
    ];
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }
}
