<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Hitung jumlah buku tersedia
        $bukuCount = Buku::where('status', 'available')->count();

        // Query dasar: hanya buku yang statusnya 'available'
        $query = Buku::where('status', 'available');

        // Search berdasarkan judul, penulis, atau kategori
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul_buku', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // Filter kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Ambil data buku dengan pagination
        $bukus = $query->latest()->paginate(10);
        $bukus->appends($request->query());

        // Ambil semua kategori unik
        $categories = Buku::distinct()->pluck('category');

        return view('user.dashboard', compact('bukuCount', 'bukus', 'categories'));
    }
}
