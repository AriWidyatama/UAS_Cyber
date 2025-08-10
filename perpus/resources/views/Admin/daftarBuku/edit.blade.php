@extends('masteradminlte.layout')

@section('content')
<div class="container">
    <h2 class="my-4 text-center">Edit Buku</h2>
    
    <div class="card shadow-sm p-4">
        <form action="{{ route('bukus.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Judul Buku -->
            <div class="form-group mb-3">
                <label for="judul_buku" class="form-label">Judul Buku:</label>
                <input type="text" name="judul_buku" class="form-control" value="{{ $buku->judul_buku }}" required>
            </div>

            {{-- Deskripsi --}}
            <div class="form-group mb-3">
                <label for="description" class="form-label">Deskripsi (opsional)</label>
                <textarea name="description" id="description" class="form-control" rows="4" placeholder="Deskripsi singkat buku">{{ old('description', $buku->description) }}</textarea>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Penulis -->
            <div class="form-group mb-3">
                <label for="penulis" class="form-label">Penulis:</label>
                <input type="text" name="penulis" class="form-control" value="{{ $buku->penulis }}">
            </div>

            <!-- Tahun Terbit -->
            <div class="form-group mb-3">
                <label for="tahun_terbit" class="form-label">Tahun Terbit:</label>
                <input type="number" name="tahun_terbit" class="form-control" value="{{ $buku->tahun_terbit }}" min="1900" max="{{ date('Y') }}">
            </div>

            <!-- Jumlah Buku -->
            <div class="form-group mb-3">
                <label for="jumlah_buku" class="form-label">Jumlah Buku:</label>
                <input type="number" name="jumlah_buku" class="form-control" value="{{ $buku->jumlah_buku }}" required>
            </div>

            <!-- Kategori -->
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

            <!-- Gambar Buku -->
            <div class="form-group mb-3">
                <label for="gambar" class="form-label">Gambar Buku:</label>
                <input type="file" name="gambar" class="form-control-file" id="gambarInput">
                @if($buku->gambar)
                    <img id="gambarPreview" src="{{ asset('storage/'.$buku->gambar) }}" alt="Gambar Buku" class="img-thumbnail mt-2" style="max-width: 120px;">
                @else
                    <img id="gambarPreview" class="img-thumbnail mt-2" style="display: none; max-width: 120px;">
                @endif
            </div>

            <!-- Status -->
            <div class="form-group mb-3">
                <label for="status" class="form-label">Status:</label>
                <select name="status" class="form-control">
                    <option value="available" {{ $buku->status == 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="unavailable" {{ $buku->status == 'unavailable' ? 'selected' : '' }}>Dipinjam</option>
                </select>
            </div>

            <!-- Tombol Aksi -->
            <div class="form-group row">
                <div class="offset-sm-0 col-sm-10">  
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Data</button>
                    <a href="{{ route('bukus.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Script untuk pratinjau gambar
    document.getElementById('gambarInput').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            document.getElementById('gambarPreview').src = URL.createObjectURL(file);
            document.getElementById('gambarPreview').style.display = 'block';
        }
    });
</script>
@endsection
