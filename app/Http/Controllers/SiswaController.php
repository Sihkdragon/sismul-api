<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function show()
    {
        $siswa = DB::table('siswas')->select('nisn', 'nama', 'kelamin', 'tanggal_lahir')->get();
        return $siswa;
    }
    public function absen()
    {
        $siswa = DB::table('siswas')->select('nisn', 'nama', 'kelamin', 'tanggal_lahir')->where('nisn', 9655147806)->first();
        DB::table('absens')->insert([
            'siswa_id' => $siswa->nisn,
            'diabsen' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // $absen = DB::table('absens')->select('nisn', 'nama', 'kelamin', 'tanggal_lahir')->get();
        // return $siswa['nisn'];
        // return $absen;
    }
}
