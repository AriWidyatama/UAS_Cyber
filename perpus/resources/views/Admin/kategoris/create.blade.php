@extends('masteradminlte.layout')

@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Tambah Kategori</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
        <!-- Form untuk menambah data kategori -->
        <form method="POST" action="{{ route('kategoris.store') }}" id="createKategoriForm">
            @csrf
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Kategori</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">
                    @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="on" {{ old('status') == 'on' ? 'checked' : '' }}>
                        <label class="form-check-label">Aktif</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="off" {{ old('status') == 'off' ? 'checked' : '' }}>
                        <label class="form-check-label">Tidak Aktif</label>
                    </div>
                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">  
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Data</button>
                    <a href="{{ route('kategoris.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>

<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Menampilkan popup pesan sukses
    @if (session('status'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('status') }}',
            timer: 3000,
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
            footer: '<a href="#">Mengapa saya melihat pesan ini?</a>',
        });
    @endif
</script>

@endsection
