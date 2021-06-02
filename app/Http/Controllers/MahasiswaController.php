<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\mahasiswa;

class MahasiswaController extends Controller
{
    public function insert()
    {
        $result = DB::insert('insert into mahasiswas (npm, nama_mahasiswa, tempat_lahir, tanggal_lahir, alamat, created_at)
        values (?, ?, ?, ?, ?, ?)', ['1822240090', 'Gabriel', 'Medan', '2000-08-06', 'Jl. Merdeka ', now()]);
        dump($result);
    }

    public function update()
    {
        $result = DB::update('update mahasiswas set nama_mahasiswa = "Stella",
        updated_at = now() where npm = ?', ['1822240099']);
        dump($result);
    }

    public function delete()
    {
        $result = DB::delete('delete from mahasiswas where npm = ?', ['1822240090']);
        dump($result);
    }

    public function select()
    {
        $kampus = "Universitas Multi Data Palembang";
        $result = DB::select('select * from mahasiswas');
        //dump($result);
        return view('mahasiswa.index', ['allmahasiswa' => $result, 'kampus' => $kampus]);
    }

    public function insertQb()
    {
        $result = DB::table('mahasiswas')->insert(
            [
                'npm' => '1822240017',
                'nama_mahasiswa' => 'Therry',
                'tempat_lahir' => 'Palembang',
                'tanggal_lahir' => '2000-03-06',
                'alamat' => 'Jl Bukit Besar',
                'created_at' => now()
            ]
        );
        dump($result);
    }

    public function updateQb()
    {
        $result = DB::table('mahasiswas')->where('npm', '1822240017')->update(  
            [
                'nama_mahasiswa' => 'Therry',
                'updated_at' => now()
            ]
        );
        dump($result);
    }

    public function deleteQb()
    {
        $result = DB::table('mahasiswas')->where('npm', '=', '1822240017')->delete();
        dump($result);
    }

    public function selectQb()
    {
        $kampus = "Universitas Multi Data Palembang";
        $result = DB::table('mahasiswas')->get();
        // dump($result);
        return view('mahasiswa.index', ['allmahasiswa' => $result, 'kampus' => $kampus]);
    }

    public function insertElq()
    {
        $mahasiswa = new Mahasiswa; // instansiasi class Mahasiswa
        $mahasiswa->npm = '1822240089'; // isi properti
        $mahasiswa->nama_mahasiswa = 'Tasya';
        $mahasiswa->tempat_lahir = 'Palembang';
        $mahasiswa->tanggal_lahir = '2001-09-20';
        $mahasiswa->alamat = 'Jl Sumpah Pemuda';
        $mahasiswa->save(); // menyimpan data ke tabel mahasiswa
        dump($mahasiswa); // lihat isi $mahasiswa
    }

    public function updateElq()
    {
        $mahasiswa = Mahasiswa::where('npm', '1822240089')->first(); // cari data berdasarkan npm
        $mahasiswa->nama_mahasiswa = 'Vinny';
        $mahasiswa->save();
        dump($mahasiswa);
    }

    public function deleteElq()
    {
        $mahasiswa = Mahasiswa::where('npm', '1822240089')->first(); // caridata
        $mahasiswa->delete(); // hapus data npm 1822240002
        dump($mahasiswa);
    }

    public function selectElq()
    {
        $kampus = "Universitas Multi Data Palembang";
        $result = Mahasiswa::all();
        // dump($result);
        return view('mahasiswa.index', ['allmahasiswa' => $result, 'kampus' => $kampus]);
    }
}