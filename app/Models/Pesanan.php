<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanans';

    protected $fillable = [
        'elektronik_id',
        'nama_pemesan',
        'alamat',
        'jumlah_pesanan',
        'metode_pembayaran',
        'setatus_pembayaran',
    ];

    // Relasi ke elektronik
    public function elektronik()
    {
        return $this->belongsTo(Elektronik::class);
    }
}
