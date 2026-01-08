<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elektronik extends Model
{
    use HasFactory;

    protected $table = 'elektroniks';

    protected $fillable = [
        'nama_barang',
        'deskripsi',
        'harga',
        'stok',
        'gambar',
    ];

    // Relasi ke pesanan
    public function pesanans()
    {
        return $this->hasMany(Pesanan::class);
    }
}
