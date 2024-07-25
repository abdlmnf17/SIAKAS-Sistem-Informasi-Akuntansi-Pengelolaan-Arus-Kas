<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KasMasuk;
use App\Models\Jurnal;
use App\Models\Akun;
use App\Models\BukuBesar;
use App\Models\Neraca;

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
        $akuns = Akun::all();
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
        return \view('kasmasuk.create', \compact('kasmasuk', 'no_kasmasuk', 'akuns'));
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
            'debit' => 'required|string|max:25',
            'kredit' => 'required|string|max:25',
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

        $jurnal = Jurnal::create([
            'no_jurnal' => $request->no_kasmasuk,
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
                if ($akun->nama_akun === 'Pendapatan') {
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
            'ref' => $request->no_kasmasuk,
        ]);

        BukuBesar::create([
            'akunbukubesar' => $request->debit,
            'totaldebit' => $request->jumlah,
            'totalkredit' => 0,
            'keterangan' => $request->keterangan,
            'ref' => $request->no_kasmasuk,
        ]);

        Neraca::create([
            'akunneraca' => $request->kredit,
            'totaldebit' => 0,
            'totalkredit' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'ref' => $request->no_kasmasuk,
        ]);

        Neraca::create([
            'akunneraca' => $request->debit,
            'totaldebit' => $request->jumlah,
            'totalkredit' => 0,
            'keterangan' => $request->keterangan,
            'ref' => $request->no_kasmasuk,
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
