<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;

    protected $table = 'permintaan';

    protected $fillable = [
        'barang_id',
        'jumlah',
        'id_user',
        'mengetahui',
        'approval',
        'keterangan',
    ];

    // Relasi
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }


    public function mengetahuiUser()
    {
        return $this->belongsTo(User::class, 'mengetahui');
    }



    public function approvalUser()
    {
        return $this->belongsTo(User::class, 'approval');
    }
}
