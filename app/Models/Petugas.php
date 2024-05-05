<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'admin_id',
        'name',
        // 'email',
        'no_hp',
        'alamat',
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }
}
