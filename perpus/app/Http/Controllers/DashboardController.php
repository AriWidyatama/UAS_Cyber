<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Buku;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // // $anggotaCount = Anggota::count();
        // $kategoriCount = MKategori::count();
        // $bukuCount = MBuku::count();
        // // $pinjamanCount = Pinjaman::count();

        // return view('admin.dashboard', compact('kategoriCount', 'bukuCount', ));
        // $anggotaCount = UserModel::count();
        // $kategoriCount = Kategori::count();
        // $bukuCount = Buku::count();
        // // $pinjamanCount = Pinjaman::count(); // Uncomment jika Anda menggunakan model ini

        // return view('admin.dashboard', compact('anggotaCount','kategoriCount', 'bukuCount'));

        //  return view('Admin.dashboard');
        $anggotaCount = User::count();
        // $kategoriCount = Kategori::count();
        $bukuCount = Buku::count();
        // $pinjamanCount = Pinjaman::count(); // Uncomment jika Anda menggunakan model ini

        return view('admin.dashboard', compact('anggotaCount', 'bukuCount'));
        
    }
}
