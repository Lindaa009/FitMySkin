<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    protected $table = 'urutan_skincare';
    protected $primaryKey = 'id_urutan';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'tanggal_diubah',
        'detail_urutan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}