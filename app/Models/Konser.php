<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konser extends Model
{
    protected $table = 'konser';

    protected $fillable = [
        'nama_konser',
        'artis',
        'lokasi',
        'tanggal',
        'harga_tiket',
        'stok_tiket',
        'deskripsi',
        'poster',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'datetime',
            'harga_tiket' => 'decimal:2',
        ];
    }
}