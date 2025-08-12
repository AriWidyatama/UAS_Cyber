<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Buku;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Hitung jumlah buku tersedia
        $bukuCount = Buku::where('status', 'available')->count();

        // hanya buku yang statusnya 'available'
        //$query = Buku::where('status', 'available');

        // Search berdasarkan judul, penulis, atau kategori
        // if ($request->filled('search')) {
        //     $search = $request->search;
        //     $query->where(function($q) use ($search) {
        //         $q->where('judul_buku', 'like', "%{$search}%")
        //           ->orWhere('penulis', 'like', "%{$search}%")
        //           ->orWhere('category', 'like', "%{$search}%");
        //     });
        // }

        // // Filter kategori
        // if ($request->filled('category')) {
        //     $query->where('category', $request->category);
        // }

        // // Ambil data buku dengan pagination
        // $bukus = $query->latest()->paginate(10);
        // $bukus->appends($request->query());

        // Ambil semua kategori unik
        $categories = Buku::distinct()->pluck('category');

        //--------------
        $bukus = DB::select("SELECT * FROM bukus WHERE status = 'available'");

        if ($request->filled('search')) {
            $search = $request->search;
            $bukus = DB::select("SELECT * FROM bukus WHERE judul_buku = '" . $_GET['search'] . "'");
        }
        //---------------

        return view('user.dashboard', compact('bukuCount', 'bukus', 'categories'));
    }
}
