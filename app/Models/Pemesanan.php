<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';

    protected $fillable = [
        'user_id',
        'konser_id',
        'jumlah_tiket',
        'total_harga',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'jumlah_tiket' => 'integer',
            'total_harga' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function konser(): BelongsTo
    {
        return $this->belongsTo(Konser::class);
    }
}