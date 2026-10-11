<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    protected $fillable = [
        'nama_user',
        'alamat_email',
        'password',
        'foto_profil',
        'tipe_kulit',
        'concerns',
        'alergi',
        'tanggal_lahir',
        'no_wa',
    ];
    protected $hidden = ['password'];

    public function products()
    {
        return $this->hasMany(Product::class, 'id_user', 'id_user');
    }

    public function journals()
    {
        return $this->hasMany(Journal::class, 'id_user', 'id_user');
    }
}