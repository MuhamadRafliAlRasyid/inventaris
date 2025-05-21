<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'nama_barang',
        'stok',
        'foto_barang',
    ];

    public $timestamps = true;

    public function permintaan()
    {
        return $this->hasMany(Permintaan::class);
    }
}
