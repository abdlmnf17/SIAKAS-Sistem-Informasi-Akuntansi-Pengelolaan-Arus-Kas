<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasMasuk extends Model
{
    use HasFactory;
    protected $table = 'kasmasuk';
    protected $fillable = ['no_kasmasuk', 'deskripsi',  'tgl', 'no_bukti', 'jumlah', 'sumber'];
}
