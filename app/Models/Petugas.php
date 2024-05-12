<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Petugas extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
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
