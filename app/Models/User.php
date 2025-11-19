<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;
    

    protected $primaryKey = 'id_user';
    
    protected $fillable = [
        'nama',
        'email',
        'password',
        'noTelepon',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

     public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_user', 'id_user');
    }


    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'id_user', 'id_user');
    }
}