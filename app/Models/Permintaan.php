<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;

    protected $table = 'permintaan';

    protected $fillable = [
        'user_id',
        'mengetahui',
        'approval',
    ];
    public function details()
    {
        return $this->hasMany(DetailPermintaan::class);
    }

    // Relasi
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Tidak perlu definisikan foreign key jika namanya 'user_id'
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
