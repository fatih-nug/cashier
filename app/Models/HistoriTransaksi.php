<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriTransaksi extends Model
{
    protected $table = 'histori_transaksi';

    protected $fillable = [
        'transaksi_id',
        'total',
        'bayar',
        'kembalian',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
