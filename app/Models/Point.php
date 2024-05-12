<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'jumlah_poin',
        'jumlah_saldo',
    ];
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }
}
