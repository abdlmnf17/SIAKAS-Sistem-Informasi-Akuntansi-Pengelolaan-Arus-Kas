<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Neraca;
use Illuminate\Support\Facades\DB;

class LabaRugiController extends Controller
{
    public function index()
    {
        // Ambil data pendapatan dan beban dari neraca
        $pendapatan = Neraca::where('akunneraca', 'like', '%Pendapatan%')
                            ->sum('totalkredit');

        $beban = Neraca::where('akunneraca', 'like', '%Beban%')
                       ->sum('totaldebit');

        // Hitung laba bersih
        $labaBersih = $pendapatan - $beban;

        return view('labarugi.index', compact('pendapatan', 'beban', 'labaBersih'));
    }
}
