<?php

namespace App\Http\Controllers;

use App\Models\BukuBesar;
use Illuminate\Http\Request;
use App\Models\KasMasuk;
use App\Models\KasKeluar;
use App\Models\Jurnal;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use App\Models\Neraca;

class PDFController extends Controller
{
    public function index (){
        return \view('pdf.index');
    }

    public function generateKasMasuk(Request $request)
      {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $tanggal_mulai = $request->input('tanggal_mulai');
        $tanggal_selesai = $request->input('tanggal_selesai');
        $kasmasuk = KasMasuk::whereBetween('tgl', [$tanggal_mulai, $tanggal_selesai])->get();
        $totalKeseluruhan = $kasmasuk->sum('jumlah');

        $pdf = PDF::loadView('pdf.kasmasuk', compact('kasmasuk', 'tanggal_mulai', 'tanggal_selesai', 'totalKeseluruhan'));


        $pdf->setPaper('A4', 'landscape');

        // Unduh PDF
        return $pdf->stream('laporan_kasmasuk'.$tanggal_mulai.'_to_'.$tanggal_selesai.'.pdf');

    }


    public function generateKasKeluar(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $tanggal_mulai = $request->input('tanggal_mulai');
        $tanggal_selesai = $request->input('tanggal_selesai');
        $kaskeluar = KasKeluar::whereBetween('tgl', [$tanggal_mulai, $tanggal_selesai])->get();
        $totalKeseluruhan = $kaskeluar->sum('jumlah');

        $pdf = PDF::loadView('pdf.kaskeluar', compact('kaskeluar', 'tanggal_mulai', 'tanggal_selesai', 'totalKeseluruhan'));


        $pdf->setPaper('A4', 'landscape');

        // Unduh PDF
        return $pdf->stream('laporan_'.$tanggal_mulai.'_to_'.$tanggal_selesai.'.pdf');
    }


    public function generateJurnal(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $tanggal_mulai = Carbon::parse($request->input('tanggal_mulai'));
        $tanggal_selesai = Carbon::parse($request->input('tanggal_selesai'));
        $jurnals = Jurnal::whereBetween('tgl', [$tanggal_mulai, $tanggal_selesai])->get();
        $totalKeseluruhan = $jurnals->sum('total');

        $pdf = PDF::loadView('pdf.jurnal', compact('jurnals', 'tanggal_mulai', 'tanggal_selesai', 'totalKeseluruhan'));


        $pdf->setPaper('A4', 'landscape');

        // Unduh PDF
        return $pdf->stream('laporan_'.$tanggal_mulai.'_to_'.$tanggal_selesai.'.pdf');
    }



    public function generateBukuBesar(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $tanggal_mulai = Carbon::parse($request->input('tanggal_mulai'));
        $tanggal_selesai = Carbon::parse($request->input('tanggal_selesai'));
        $BukuBesar = Jurnal::whereBetween('tgl', [$tanggal_mulai, $tanggal_selesai])->get();
        $BukuBesarAll = BukuBesar::all();
        $totalDebit = $BukuBesarAll->sum('totaldebit');
        $totalKredit = $BukuBesarAll->sum('totalkredit');

        $pdf = PDF::loadView('pdf.bukubesar', compact('BukuBesar', 'tanggal_mulai', 'tanggal_selesai', 'totalDebit', 'totalKredit', 'BukuBesarAll'));


        $pdf->setPaper('A4', 'landscape');

        // Unduh PDF
        return $pdf->stream('laporan_'.$tanggal_mulai.'_to_'.$tanggal_selesai.'.pdf');
    }


    public function generateNeraca(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $tanggal_mulai = Carbon::parse($request->input('tanggal_mulai'));
        $tanggal_selesai = Carbon::parse($request->input('tanggal_selesai'));
        $neraca = Jurnal::whereBetween('tgl', [$tanggal_mulai, $tanggal_selesai])->get();
        $NeracaAll = Neraca::all();
        $totalDebit = $NeracaAll->sum('totaldebit');
        $totalKredit = $NeracaAll->sum('totalkredit');

        // Menghitung total jumlah debit dan kredit berdasarkan selisih
        $totalJumlahDebit = 0;
        $totalJumlahKredit = 0;
        foreach ($NeracaAll as $buku) {
            $selisih = $buku->totaldebit - $buku->totalkredit;
            if ($selisih > 0) {
                $totalJumlahDebit += $selisih;
            } else {
                $totalJumlahKredit += abs($selisih);
            }
        }

        $pdf = PDF::loadView('pdf.neraca', compact('neraca', 'tanggal_mulai', 'tanggal_selesai', 'totalDebit', 'totalKredit', 'NeracaAll', 'totalJumlahDebit', 'totalJumlahKredit'));


        $pdf->setPaper('A4', 'landscape');

        // Unduh PDF
        return $pdf->stream('laporan_'.$tanggal_mulai.'_to_'.$tanggal_selesai.'.pdf');
    }

    public function generateRugiLaba(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);
        // Ambil data pendapatan dan beban dari neraca
        $pendapatan = Neraca::where('akunneraca', 'like', '%Pendapatan%')
                            ->sum('totalkredit');

        $beban = Neraca::where('akunneraca', 'like', '%Beban%')
                       ->sum('totaldebit');

        // Hitung laba bersih
        $labaBersih = $pendapatan - $beban;


        $tanggal_mulai = Carbon::parse($request->input('tanggal_mulai'));
        $tanggal_selesai = Carbon::parse($request->input('tanggal_selesai'));
        $laporan = Jurnal::whereBetween('tgl', [$tanggal_mulai, $tanggal_selesai])->get();



        $pdf = PDF::loadView('pdf.rugilaba', compact('laporan', 'tanggal_mulai', 'tanggal_selesai', 'labaBersih', 'beban', 'pendapatan'));


        $pdf->setPaper('A4', 'landscape');

        // Unduh PDF
        return $pdf->stream('laporan_'.$tanggal_mulai.'_to_'.$tanggal_selesai.'.pdf');
    }


}
