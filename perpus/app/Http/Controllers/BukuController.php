<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
// use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $bukus = Buku::all(); // Mengambil semua data buku
        // return view('admin.daftarBuku.index', compact('bukus'));
        // $bukus = Buku::with('kategori')->get();
        // return view('admin.daftarBuku.index', compact('bukus'));
        // $bukus = Buku::all();
        
    $query = Buku::query();

    // Search (judul, penulis, kategori)
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('judul_buku', 'like', "%{$search}%")
              ->orWhere('penulis', 'like', "%{$search}%")
              ->orWhere('category', 'like', "%{$search}%");
        });
    }

    // Filter kategori
    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    // Filter status (available/unavailable)
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Ambil data + pagination
    $bukus = $query->latest()->paginate(10);
    $bukus->appends($request->query());

    // Ambil semua kategori untuk dropdown
    $categories = Buku::distinct()->pluck('category');

    return view('admin.daftarBuku.index', compact('bukus', 'categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $kategoris = MKategori::all(); // Mengambil semua kategori untuk form
        // return view('admin.daftarBuku.create', compact('kategoris'));
        // $kategoris = Kategori::where('status', 'on')->get();
        // return view('admin.daftarBuku.create', compact('kategoris'));
        return view('Admin.daftarBuku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_buku' => 'required|string|max:255',
            'description' => 'required',
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'jumlah_buku' => 'required|integer|min:1',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string',
            'status' => 'required|in:available,unavailable',
        ]);
        // $validated['status'] = trim($request->input('status'));


        // Upload gambar buku
        // if ($request->hasFile('gambar')) {
        //     $gambarPath = $request->file('gambar')->store('gambar_buku', 'public'); // Menyimpan gambar di folder storage/app/public/gambar_buku
        //     $validated['gambar'] = $gambarPath;
        // }
        if ($request->hasFile('gambar')) {
            // Ambil file dari input
            $file = $request->file('gambar');
            
            // Buat nama file berdasarkan judul buku, hilangkan spasi dan tambahkan ekstensi file
            $fileName = Str::slug($validated['judul_buku'], '_') . '.' . $file->getClientOriginalExtension();
            
            // Simpan file dengan nama baru di folder 'gambar_buku'
            $gambarPath = $file->storeAs('cover_buku', $fileName, 'public');
            $validated['gambar'] = $gambarPath;
        }
        // if ($request->hasFile('gambar')) {
        //     // Ambil file dari input
        //     $file = $request->file('gambar');
            
        //     // Buat nama file baru
        //     $fileName = 'cover_buku.' . $file->getClientOriginalExtension();
            
        //     // Simpan file dengan nama baru di folder 'gambar_buku'
        //     $gambarPath = $file->storeAs('gambar_buku', $fileName, 'public');
        //     $validated['gambar'] = $gambarPath;
        // }

        // Simpan data ke database
        Buku::create($validated);

        // Redirect dengan pesan sukses
        // return redirect()->route('bukus.index')->with('status', 'Kategori berhasil disimpan!');
        // return redirect()->route('bukus.index')->with('success', 'Buku berhasil ditambahkan.');
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil ditambahkan.');

        // return redirect()->route('kategoris.index')->with('status', 'Kategori berhasil disimpan!');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buku = Buku::findOrFail($id);
        return view('admin.daftarBuku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $buku = MBuku::findOrFail($id);
        // $kategoris = MKategori::all();
        // return view('admin.daftarBuku.edit', compact('buku', 'kategoris'));
    //     $buku = MBuku::find($id); // Gantilah Buku dengan model yang sesuai
    // return view('admin.daftarBuku.edit', compact('buku'));
    // $buku = Buku::findOrFail($id); // Pastikan menggunakan findOrFail agar lebih aman
    // $kategoris = Kategori::where('status', 'on')->get(); // Ambil kategori yang aktif
        $buku = Buku::findOrFail($id);
        return view('admin.daftarBuku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_buku' => 'required|string|max:255',
            'description' => 'required',
            'penulis' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|integer|min:1900|max:' . date('Y'),
            'jumlah_buku' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string',
            'status' => 'required|in:available,unavailable',
        ]);
    
        $buku = Buku::findOrFail($id);
    
        // Update gambar jika ada file baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($buku->gambar) {
                Storage::disk('public')->delete($buku->gambar);
            }
            // Simpan gambar baru
            $file = $request->file('gambar');
            $fileName = Str::slug($request->judul_buku, '_') . '.' . $file->getClientOriginalExtension();
            $gambarPath = $file->storeAs('cover_buku', $fileName, 'public');
            $buku->gambar = $gambarPath;
        }
    
        // Update data buku lainnya
        $buku->update($request->except('gambar')); // Simpan data kecuali gambar karena sudah dihandle
    
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect()->route('bukus.index')->with('success', 'Buku berhasil dihapus.');
    }
}
