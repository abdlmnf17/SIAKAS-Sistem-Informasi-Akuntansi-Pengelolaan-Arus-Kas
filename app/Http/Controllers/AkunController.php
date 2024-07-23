<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akun = Akun::all();
        return \view('akun.akun', \compact('akun'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('akun.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_akun' => 'required',
            'jenis_akun' => 'required',
            'kode_akun' => 'required|unique:akun',
        ]);

        Akun::create($request->all());

        return redirect()->route('akun.index')
                        ->with('success', 'Akun berhasil disimpan.');

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
    public function edit(Akun $akun)
    {

        return \view('akun.edit', \compact('akun'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Akun $akun)
    {
        $request->validate([
            'nama_akun' => 'required',
            'jenis_akun' => 'required',
            'kode_akun' => 'required',
        ]);

        $akun->update($request->all());

        return redirect()->route('akun.index')
                        ->with('success', 'Akun berhasil diperbarui.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Akun $akun)
    {
        $akun->delete();

        return redirect()->route('akun.index')
                        ->with('success', 'Akun berhasil dihapus.');
    }
}
