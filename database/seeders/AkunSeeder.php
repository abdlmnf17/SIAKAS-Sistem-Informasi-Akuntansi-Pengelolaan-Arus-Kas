<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Akun;
use Illuminate\Support\Carbon;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tambahkan data akun ke dalam tabel 'akun'
        Akun::create([
            'nama_akun' => 'Kas',
            'kode_akun' => 101,
            'jenis_akun' => 'Asset',
            'total' => 1000000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Akun::create([
            'nama_akun' => 'Modal Pemilik',
            'kode_akun' => 301,
            'jenis_akun' => 'Modal',
            'total' => 1000000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        Akun::create([
            'nama_akun' => 'Utang Usaha',
            'jenis_akun' => 'Kewajiban',
            'kode_akun' => 201,
            'total' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Akun::create([
            'nama_akun' => 'Pendapatan Usaha',
            'jenis_akun' => 'Pendapatan',
            'kode_akun' => 401,
            'total' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Akun::create([
            'nama_akun' => 'Beban Lain',
            'jenis_akun' => 'Beban',
            'kode_akun' => 501,
            'total' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Tambahkan data lain jika diperlukan
    }
}
