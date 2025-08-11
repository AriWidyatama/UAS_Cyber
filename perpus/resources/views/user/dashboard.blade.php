@extends('usermasteradminlte.layout')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <h1 class="m-0 text-center">Dashboard User</h1>
  </div>
</div>

<div class="container-fluid">
  <!-- Statistik jumlah buku -->
  <div class="row mb-4">
    <div class="col-lg-3 col-6">
      <div class="small-box bg-warning shadow-sm rounded">
        <div class="inner">
          <h3>{{ $bukuCount }}</h3>
          <p>Buku Tersedia</p>
        </div>
        <div class="icon">
          <i class="fas fa-book"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Filter Form -->
<form method="GET" class="mb-4">
    <div class="row g-2 align-items-center">
        <!-- Search -->
        <div class="col-md-6">
            <input type="text" name="search" class="form-control" 
                   placeholder="Cari buku..." value="{{ request('search') }}">
        </div>

        <!-- Category -->
        <div class="col-md-3">
            <select name="category" class="form-control">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                        {{ $category }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Button -->
        <div class="col-md-3">
            <button type="submit" class="btn btn-outline-primary w-100">
                <i class="fas fa-search"></i> Filter
            </button>
        </div>
    </div>
</form>
                
  <!-- Daftar Buku -->
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Daftar Buku Tersedia</h4>
    </div>
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
            @forelse ($bukus as $buku)
              <tr class="align-middle">
                <td class="text-center">
                  <img src="{{ asset('storage/'.$buku->gambar) }}" alt="Gambar Buku" 
                       class="img-fluid rounded" style="max-width: 60px;">
                </td>
                <td>{{ $buku->judul_buku }}</td>
                <td>{{ $buku->penulis }}</td>
                <td><span class="badge badge-success">Tersedia</span></td>
                <td>{{ $buku->category }}</td>
                <td class="text-center">
                  <a href="{{ route('user.bukus.show', $buku->id) }}" class="btn btn-info btn-sm">
                    <i class="fa fa-eye"></i> Lihat
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center text-muted">Tidak ada buku tersedia</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection
