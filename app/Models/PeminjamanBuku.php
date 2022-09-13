<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanBuku extends Model
{
    protected $table = 'peminjaman_buku';
    protected $primaryKey = 'id_pbuku';
    public $timestamps = false;

    protected $fillable = ['id_siswa', 'tgl_pinjam', 'tgl_kembali'];
}
