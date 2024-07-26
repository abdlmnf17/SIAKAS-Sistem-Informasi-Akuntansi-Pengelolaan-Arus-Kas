<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Akun;
use App\Models\KasMasuk;
use App\Models\KasKeluar;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $akunKas = Akun::where('jenis_akun', 'Asset')->sum('total');
        $akunPen = Akun::where('jenis_akun', 'Pendapatan')->sum('total');
        $akunPeng = Akun::where('jenis_akun', 'Beban')->sum('total');
        $user = User::count();
        $kasmasuk = KasMasuk::count();
        $kaskeluar = KasKeluar::count();

        return view('home', compact('akunKas', 'akunPen', 'akunPeng', 'user', 'kasmasuk', 'kaskeluar'));
    }

    }
