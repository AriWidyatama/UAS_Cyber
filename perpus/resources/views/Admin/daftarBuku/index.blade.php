@extends('masteradminlte.layout')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Daftar Buku</h1>
    <div class="mb-4 d-flex justify-content-between">
        <h5 class="text-muted">Kelola buku dalam perpustakaan Anda dengan mudah</h5>
        <a href="{{ route('bukus.create') }}" class="btn btn-primary shadow-sm">
            <i class="fa fa-solid fa-plus"></i> Tambah Data
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>Gambar</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Status</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bukus as $buku)
                            <tr class="align-middle">
                                <td class="text-center">
                                    <img src="{{ asset('storage/'.$buku->gambar) }}" 
                                         alt="Gambar Buku" 
                                         class="img-fluid rounded" 
                                         style="max-width: 60px;">
                                </td>
                                <td>{{ $buku->judul_buku }}</td>
                                <td>{{ $buku->penulis }}</td>
                                <td>
                                    @if ($buku->status === 'available')
                                        <span class="badge badge-success">Tersedia</span>
                                    @else
                                        <span class="badge badge-danger">Habis Dipinjam</span>
                                    @endif
                                </td>
                                <td>{{ $buku->category }}</td>
                                <td class="text-center">
                                    <a href="{{ route('bukus.show', $buku->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i> Show
                                    </a>
                                    <a href="{{ route('bukus.edit', $buku->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('bukus.destroy', $buku->id) }}" method="POST" style="display:inline;" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-button">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 1500, // Menampilkan popup selama 3 detik
                showConfirmButton: false
            });
        @endif

        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const form = this.closest('.delete-form');
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit form jika user mengonfirmasi
                    }
                });
            });
        });
    });
</script>
@endsection
