<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPermintaan extends Model
{
    protected $table = 'detail_permintaan'; // pastikan sesuai dengan nama tabelmu

    protected $fillable = [
        'permintaan_id',
        'barang_id',
        'jumlah',
        'satuan',       // baru
        'tanggal',      // baru
        'keterangan'
    ];


    public function permintaan()
    {
        return $this->belongsTo(Permintaan::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
