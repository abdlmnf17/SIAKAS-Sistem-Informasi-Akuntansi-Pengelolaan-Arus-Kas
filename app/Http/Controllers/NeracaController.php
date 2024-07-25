<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Neraca;
use Illuminate\Support\Facades\DB;

class NeracaController extends Controller
{
    public function index()
    {
        $neraca = Neraca::select('akunneraca',
                                       DB::raw('SUM(totaldebit) as totaldebit'),
                                       DB::raw('SUM(totalkredit) as totalkredit'))
                              ->groupBy('akunneraca')
                              ->orderBy('akunneraca', 'asc')
                              ->get();

        $transaksi = Neraca::orderBy('akunneraca', 'asc')->get();

        $totalDebit = $neraca->sum('totaldebit');
        $totalKredit = $neraca->sum('totalkredit');

        // Menghitung total jumlah debit dan kredit berdasarkan selisih
        $totalJumlahDebit = 0;
        $totalJumlahKredit = 0;
        foreach ($neraca as $buku) {
            $selisih = $buku->totaldebit - $buku->totalkredit;
            if ($selisih > 0) {
                $totalJumlahDebit += $selisih;
            } else {
                $totalJumlahKredit += abs($selisih);
            }
        }

        return view('neraca.index', compact('neraca', 'transaksi', 'totalDebit', 'totalKredit', 'totalJumlahDebit', 'totalJumlahKredit'));
    }

    public function destroy($id)
    {
        $neraca = Neraca::findOrFail($id);
        $neraca->delete();

        return redirect()->route('neraca.index')->with('success', 'Neraca berhasil dihapus.');
    }
}

