<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPermintaan extends Model
{
    protected $table = 'detail_permintaan';     

    protected $fillable = [
        'permintaan_id',
        'barang_id',
        'jumlah',
        'satuan',       
        'tanggal',      
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
