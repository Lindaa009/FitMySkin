<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id_product';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'nama_produk',
        'merek',
        'bahan_aktif',
        'jenis_produk',
        'jadwal_pemakaian',
        'status_pemakaian',
        'catatan_product',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function journals()
    {
        return $this->hasMany(Journal::class, 'id_product', 'id_product');
    }
}