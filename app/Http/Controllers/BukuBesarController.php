<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuBesar;
use Illuminate\Support\Facades\DB;

class BukuBesarController extends Controller
{
    public function index()
{
    $bukubesar = BukuBesar::orderBy('akunbukubesar', 'asc')->get();
    $totalDebit = $bukubesar->sum('totaldebit');
    $totalKredit = $bukubesar->sum('totalkredit');

    return view('bukubesar.index', compact('bukubesar', 'totalDebit', 'totalKredit'));
}

public function destroy($id)
{
    $bukubesar = BukuBesar::findOrFail($id);
    $bukubesar->delete();

    return redirect()->route('bukubesar.index')->with('success', 'Data berhasil dihapus.');
}
}
