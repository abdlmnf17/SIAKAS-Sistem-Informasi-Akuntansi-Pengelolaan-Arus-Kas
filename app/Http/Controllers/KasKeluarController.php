<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KasKeluar;
use Illuminate\Cache\LuaScripts;
use App\Models\Jurnal;
use App\Models\Akun;
use App\Models\BukuBesar;
use App\Models\Neraca;

class KasKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kaskeluar = KasKeluar::all();
        return \view('kaskeluar.kaskeluar', compact('kaskeluar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $akuns = Akun::all();
        $kaskeluar = KasKeluar::all();
        // Generate nomor transaksi
        $tanggal = now(); // atau Anda dapat mengatur tanggal sesuai kebutuhan
        $no_kaskeluar = "KASKELUAR/" . $tanggal->format('m-Y') . "/";

        // Cari nomor transaksi terakhir dari database
        $last_trans = KasKeluar::where('no_kaskeluar', 'like', $no_kaskeluar . '%')->orderBy('created_at', 'desc')->first();

        // Jika nomor transaksi sudah ada di database, tambahkan angka di belakangnya
        if ($last_trans) {
            $last_no = explode('/', $last_trans->no_kaskeluar);
            $last_num = intval(end($last_no));
            $no_kaskeluar .= str_pad($last_num + 1, 2, '0', STR_PAD_LEFT);
        } else {
            $no_kaskeluar .= '01';
        }
        return \view('kaskeluar.create', \compact('kaskeluar', 'no_kaskeluar', 'akuns'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi.',
            'unique' => ':attribute sudah terdaftar. Silakan input yang lain.',
            'max' => ':attribute Maksimal :max karakter.',
        ];

        $request->validate([
            'tgl' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'no_bukti' => 'required|string|max:20|unique:kaskeluar',
            'no_kaskeluar' => 'required|string|max:20|unique:kaskeluar',
            'sumber' => 'required|string|max:25',
            'debit' => 'required|string|max:25',
            'kredit' => 'required|string|max:25',
        ], $messages, [
            'tgl' => 'Tanggal Transaksi',
            'keterangan' => 'Keterangan',
            'jumlah' => 'Total Jumlah',
            'sumber' => 'Sumber',
            'no_bukti' => 'Nomer Bukti',
            'no_kaskeluar' => 'Nomer Kas Keluar',
        ]);

        $transaksi = KasKeluar::create([
            'no_kaskeluar' => $request->no_kaskeluar,
            'deskripsi' => $request->keterangan,
            'no_bukti' => $request->no_bukti,
            'tgl' => $request->tgl,
            'jumlah' => $request->jumlah,
            'sumber' => $request->sumber,
        ]);

        $jurnal = Jurnal::create([
            'no_jurnal' => $request->no_kaskeluar,
            'keterangan' => $request->keterangan,
            'debit' => $request->debit,
            'kredit' => $request->kredit,
            'total' => $request->jumlah,
            'tgl' => $request->tgl,
            'no_bukti' => $request->no_bukti,

        ]);


        if ($request->debit) {
            $akun = Akun::where('nama_akun', $request->debit)->first();
            if ($akun) {
                $akun->total += $request->jumlah;
                $akun->save();
            }
        }

        if ($request->kredit) {
            $akun = Akun::where('nama_akun', $request->kredit)->first();
            if ($akun) {
                if ($akun->jenis_akun === 'Pendapatan') {
                    // Jika nama akun adalah Pendapatan, tambahkan total
                    $akun->total += $request->jumlah;
                } else {
                    // Jika nama akun bukan Pendapatan, kurangi total
                    $akun->total -= $request->jumlah;
                }
                $akun->save();
            }
        }


        BukuBesar::create([
            'akunbukubesar' => $request->kredit,
            'totaldebit' => 0,
            'totalkredit' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'ref' => $request->no_kaskeluar,
        ]);

        BukuBesar::create([
            'akunbukubesar' => $request->debit,
            'totaldebit' => $request->jumlah,
            'totalkredit' => 0,
            'keterangan' => $request->keterangan,
            'ref' => $request->no_kaskeluar,
        ]);

        Neraca::create([
            'akunneraca' => $request->kredit,
            'totaldebit' => 0,
            'totalkredit' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'ref' => $request->no_kaskeluar,
        ]);

        Neraca::create([
            'akunneraca' => $request->debit,
            'totaldebit' => $request->jumlah,
            'totalkredit' => 0,
            'keterangan' => $request->keterangan,
            'ref' => $request->no_kaskeluar,
        ]);


        return \redirect()->route('kaskeluar.index')->with('success', 'Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $kaskeluar = KasKeluar::findOrFail($id);
        $kaskeluar->delete();

        return \redirect()->route('kaskeluar.index')->with('success', 'Berhasil dihapus');
    }
}
