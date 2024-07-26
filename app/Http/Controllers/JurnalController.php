<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
use DB;
use App\Models\Jurnal;

class JurnalController extends Controller
{
    public function index()
    {
        $akuns = Akun::all();
        $jurnals = Jurnal::all();
        $totalDebit = $jurnals->sum('total');
        $totalKredit = $jurnals->sum('total');

        return view('jurnal.jurnal', compact('akuns', 'jurnals', 'totalDebit', 'totalKredit'));
    }
    public function destroy($id) {

        $jurnal = Jurnal::findOrFail($id);
        $jurnal->delete();
        return \redirect()->route('jurnal.index')->with('success', 'Jurnal berhasil dihapus');
    }


public function reset()
{
    try {
        DB::table('jurnal')->truncate(); // Menghapus semua data di tabel bukubesar
        return redirect()->back()->with('success', 'Seluruh isi jurnal berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
    }
}



}
