<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','judul','kategori','lokasi','deskripsi','foto','status','tanggapan_admin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengaduan()
{
    return $this->hasMany(Pengaduan::class);
}

}

