@extends('masteradminlte.layout')

@section('content')
<div class="container">
    <h1>Daftar Kategori</h1>
    
    {{-- <a href="{{ route('kategoris.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a> --}}

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card-body">
        <a href="{{ route('kategoris.create') }}">
            <button type="button" class="btn btn-primary"><i class="fa fa-solid fa-plus"></i> Tambah Data</button>
        </a>
    </div>
    <div class="card-body">
       
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <style>
                .status-active {
                    background-color: #d4edda;
                    color: #155724;
                    padding: 0.2rem 0.5rem;
                    border-radius: 0.25rem;
                }
                .status-inactive {
                    background-color: #f8d7da;
                    color: #721c24;
                    padding: 0.2rem 0.5rem;
                    border-radius: 0.25rem;
                }
            </style>
            <tbody>
                @forelse($kategoris as $kategori)
                    <tr>
                        <td>{{ $kategori->id_kategori }}</td>
                        <td>{{ $kategori->nama_kategori }}</td>
                        {{-- <td>{{ $kategori->status }}</td> --}}
                        {{-- <td>
                            <span class="badge {{ $kategori->status == 'on' ? 'badge-success' : 'badge-danger' }}">
                                {{ $kategori->status == 'on' ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td> --}}
                        <td>
                            @if($kategori->status == 'on')
                                <span class="status-active">Aktif</span>
                            @else
                                <span class="status-inactive">Tidak Aktif</span>
                            @endif
                        </td>
                        {{-- <td>
                            @if($kategori->status == 'on')
                                <span class="badge badge-success">Aktif</span> <!-- Hijau untuk status 'on' -->
                            @else
                                <span class="badge badge-danger">Tidak Aktif</span> <!-- Merah untuk status 'off' -->
                            @endif
                        </td> --}}
                        <td>
                            <a href="{{ route('kategoris.edit', $kategori->id_kategori) }}" class="btn btn-warning"><i class="fa fa-solid fa-edit"></i>Edit</a>
                            {{-- <form action="{{ route('kategoris.destroy', $kategori->id_kategori) }}" method="POST" style="display:inline;" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger delete-button">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form> --}}
                            <form action="{{ route('kategoris.destroy', $kategori->id_kategori) }}" method="POST" style="display:inline;" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger delete-button">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                            
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Data kategori kosong</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    
</div>

<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Menampilkan popup pesan sukses jika ada session 'status'
        @if (session('status'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('status') }}',
                timer: 1500,
                showConfirmButton: false
            });
        @endif

        // Menampilkan popup error jika ada validasi gagal
        @if ($errors->any())
            let errorMessage = '';
            @foreach ($errors->all() as $error)
                errorMessage += '- {{ $error }}<br>';
            @endforeach

            Swal.fire({
                icon: 'error',
                title: 'Oops! Ada yang salah.',
                html: errorMessage,
                confirmButtonText: 'Perbaiki',
            });
        @endif

        // Konfirmasi penghapusan data dengan SweetAlert2
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


