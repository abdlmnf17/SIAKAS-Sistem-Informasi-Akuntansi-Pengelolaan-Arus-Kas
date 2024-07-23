<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KasMasuk;


class KasMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kasmasuk = KasMasuk::all();
        return \view('kasmasuk.kasmasuk', \compact('kasmasuk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kasmasuk = KasMasuk::all();
          // Generate nomor transaksi
          $tanggal = now(); // atau Anda dapat mengatur tanggal sesuai kebutuhan
          $no_kasmasuk = "KASMASUK/" . $tanggal->format('m-Y') . "/";

          // Cari nomor transaksi terakhir dari database
          $last_trans = KasMasuk::where('no_kasmasuk', 'like', $no_kasmasuk . '%')->orderBy('created_at', 'desc')->first();

          // Jika nomor transaksi sudah ada di database, tambahkan angka di belakangnya
          if ($last_trans) {
              $last_no = explode('/', $last_trans->no_kasmasuk);
              $last_num = intval(end($last_no));
              $no_kasmasuk .= str_pad($last_num + 1, 2, '0', STR_PAD_LEFT);
          } else {
              $no_kasmasuk .= '01';
          }
        return \view('kasmasuk.create', \compact('kasmasuk', 'no_kasmasuk'));
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
            'no_bukti' => 'required|string|max:20|unique:kasmasuk',
            'no_kasmasuk' => 'required|string|max:20|unique:kasmasuk',
            'sumber' => 'required|string|max:25',
        ], $messages, [
            'tgl' => 'Tanggal Transaksi',
            'keterangan' => 'Keterangan',
            'jumlah' => 'Total Jumlah',
            'sumber' => 'Sumber',
            'no_bukti' => 'Nomer Bukti',
            'no_kasmasuk' => 'Nomer Kas Masuk',
        ]);

        $transaksi = KasMasuk::create([
            'no_kasmasuk' => $request->no_kasmasuk,
            'deskripsi' => $request->keterangan,
            'no_bukti' => $request->no_bukti,
            'tgl' => $request->tgl,
            'jumlah' => $request->jumlah,
            'sumber' => $request->sumber,
        ]);

        return \redirect()->route('kasmasuk.index')->with('success', 'Berhasil di tambahkan');
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
        $kasmasuk = KasMasuk::findOrFail($id);
        $kasmasuk->delete();

        return \redirect()->route('kasmasuk.index')->with('success', 'Berhasil dihapus');
    }
}
