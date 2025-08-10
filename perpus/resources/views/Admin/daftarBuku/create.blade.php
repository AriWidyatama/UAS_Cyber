@extends('masteradminlte.layout')

@section('content')
<div class="container">
    <h2 class="my-4 text-center">Tambah Buku Baru</h2>
    
    <div class="card shadow-sm p-4">
        <form action="{{ route('bukus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group mb-3">
                <label for="judul_buku" class="form-label">Judul Buku</label>
                {{-- <input type="text" class="form-control" id="judul_buku" name="judul_buku" value="{{ old('nama') }}" required> --}}
                <input type="text" name="judul_buku" id="judul_buku" class="form-control" placeholder="Masukkan judul buku" required>
            </div>

            <div class="form-group mb-3">
                <label for="description" class="form-label">Deskripsi (opsional)</label>
                <textarea name="description" id="description" class="form-control" rows="4" placeholder="Deskripsi singkat buku">{{ old('description') }}</textarea>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" name="penulis" id="penulis" class="form-control" placeholder="Masukkan nama penulis" required>
            </div>

            <div class="form-group mb-3">
                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                <input type="number" name="tahun_terbit" id="tahun_terbit" class="form-control" placeholder="Masukkan tahun terbit" min="1900" max="{{ date('Y') }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="jumlah_buku" class="form-label">Jumlah Buku</label>
                <input type="number" name="jumlah_buku" id="jumlah_buku" class="form-control" placeholder="Masukkan jumlah buku" min="1" required>
            </div>

            <div class="form-group mb-3">
                <label for="gambar" class="form-label">Gambar Buku</label>
                <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*" required>
            </div>

            <div class="form-group mb-3">
                <label for="category" class="form-label">Kategori</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="Novel">Novel</option>
                    <option value="Komik">Komik</option>
                    <option value="Majalah">Majalah</option>
                    <option value="Berita">Berita</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="form-group mb-4">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="available">Tersedia</option>
                    <option value="unavailable">Tidak Tersedia</option>
                </select>
            </div>
            <div class="form-group row">
                <div class="offset-sm-0 col-sm-10">  
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Data</button>
                    <a href="{{ route('bukus.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
            {{-- <button type="submit" class="btn btn-primary btn-block shadow-sm"><i class="fa fa-save"></i> Simpan Buku</button> --}}
        </form>
    </div>
</div>
@endsection
