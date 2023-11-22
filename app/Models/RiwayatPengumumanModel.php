<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPengumumanModel extends Model
{
    use HasFactory;

    protected $table = 'riwayat_pengumuman';

    protected $fillable = [
        'id',
        'judul',
        'tanggal_upload',
        'tanggal_delete',
        'konten',
        'created_at'
    ];
}
