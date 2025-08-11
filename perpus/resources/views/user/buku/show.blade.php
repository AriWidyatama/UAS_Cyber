@extends('usermasteradminlte.layout')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Detail Buku</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <!-- Gambar Buku -->
                <div class="col-md-4 text-center">
                    <img src="{{ asset('storage/'.$buku->gambar) }}" 
                         alt="Gambar Buku" 
                         class="img-fluid rounded mb-3"
                         style="max-height: 300px;">
                    <br>
                    <table class="table">
                        <tr>
                                 {{-- <th class="fs-4" width="30%">Judul Buku</th> --}}
                            <th style="font-size: 2rem;" width="30%">{{ $buku->judul_buku }}</th>
                        </tr>
                    </table>
                </div>

                <!-- Detail Buku -->
                <div class="col-md-8">
                    <table class="table table-borderless">
                        
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $buku->description }}</td>
                        </tr>
                        <tr>
                            <th>Penulis</th>
                            <td>{{ $buku->penulis }}</td>
                        </tr>
                        <tr>
                            <th>Tahun Terbit</th>
                            <td>{{ $buku->tahun_terbit }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Buku</th>
                            <td>{{ $buku->jumlah_buku }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $buku->category }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if ($buku->status === 'available')
                                    <span class="badge badge-success">Tersedia</span>
                                @else
                                    <span class="badge badge-danger">Habis Dipinjam</span>
                                @endif
                            </td>
                        </tr>
                        {{-- <tr>
                            <th>Created</th>
                            <td>{{ $buku->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Update</th>
                            <td>{{ $buku->update_at }}</td>
                        </tr> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>

    <tr>
        <div class="mt-3 d-flex justify-content-center gap-2 px-3">
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    <tr>
</div>
@endsection
