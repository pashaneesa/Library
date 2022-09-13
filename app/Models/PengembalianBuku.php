<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengembalianBuku extends Model
{
    protected $table = 'pengembalian_buku';
    protected $primaryKey = 'id_kbuku';
    public $timestamps = false;

    protected $fillable = ['id_pbuku', 'tgl_kembali', 'denda'];
}
