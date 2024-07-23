<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasKeluar extends Model
{
    use HasFactory;
    protected $table = 'kaskeluar';
    protected $fillable = ['no_kaskeluar', 'deskripsi',  'tgl', 'no_bukti', 'jumlah', 'sumber'];
}
