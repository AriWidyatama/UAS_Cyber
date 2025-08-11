<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class UserBukuController extends Controller
{
    //
        public function daftarBukuUser()
    {
        $bukus = Buku::where('status', 'available')->get();
        return view('user.dashboard', compact('bukus'));
    }

    public function show($id)
    {
        // Cari buku yang tersedia saja
        $buku = Buku::where('status', 'available')->findOrFail($id);

        return view('user.buku.show', compact('buku'));
    }
}
