<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuBesar extends Model
{
    use HasFactory;
    protected $table = 'buku_besar';
    protected $fillable = ['akunbukubesar', 'totaldebit', 'totalkredit', 'ref', 'keterangan'];
}
