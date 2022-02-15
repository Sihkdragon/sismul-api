<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function show()
    {
        $siswa = DB::table('siswas')->select('nik', 'nama', 'kelamin', 'tanggal_lahir')->get();
        return $siswa;
    }
    public function absen(Request $request)
    {
        $siswa = DB::table('siswas')->select('nik', 'nama', 'kelamin', 'tanggal_lahir')->where('nik', $request->header('nik'))->first();
        DB::table('absens')->insert([
            'siswa_id' => $siswa->nik,
            'name' => $siswa->nik,
            'diabsen' => today(),
            'jam' => now('GMT+7'),
            'created_at' => now(),
            'updated_at' => now()
        ]);


        // $absen = DB::table('absens')->select('nisn', 'nama', 'kelamin', 'tanggal_lahir')->get();
        // return $siswa['nisn'];
        // return $absen;
    }
    public function todaydata()
    {
        $data = DB::table('absens')
            ->join('siswas', 'absens.siswa_id', '=', 'siswas.nik')
            ->select('absens.siswa_id', 'siswas.nama')->where('absens.diabsen', today())
            ->get();
        return $data;
    }
    public function alldata()
    {
        DB::enableQueryLog();
        $latestabsen = DB::table('absens')
            ->select('siswa_id', DB::raw('MAX(diabsen) as last_diabsen'))
            ->groupBy('siswa_id');

        $data = DB::table('siswas')->select('siswas.nik', 'siswas.nama', 'latestabsen.last_diabsen')
            ->leftJoinSub($latestabsen, 'latestabsen', function ($join) {
                $join->on('siswas.nik', '=', 'latestabsen.siswa_id');
            })->get();

        // return DB::getQueryLog();
        return $data->toJson();
    }
    public function homedata()
    {
        $data = DB::table('absens')
            ->join('siswas', 'absens.siswa_id', '=', 'siswas.nik')
            ->select('absens.id', 'absens.siswa_id', 'siswas.nama')->orderBy('absens.jam', 'desc')
            ->get();
        return $data;
    }
}


// add artisan serve custom php artisan serve --host 192.168.18.18 --port 8000

// postman example url http://192.168.18.18:8000/homedata