<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeminjamanBuku extends Model
{
    protected $table = 'detail_peminjaman';
    protected $primaryKey = 'id_dpbuku';
    public $timestamps = false;

    protected $fillable = ['id_pbuku', 'id_buku', 'qty'];
}
