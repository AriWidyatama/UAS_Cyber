@extends('masteradminlte.layout')

@section('content')
<div class="container">
    <h1>Edit Kategori</h1>
    <form action="{{ route('kategoris.update', $kategori->id_kategori) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ $kategori->nama_kategori }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="status_on" value="on" {{ $kategori->status == 'on' ? 'checked' : '' }}>
                <label class="form-check-label" for="status_on">
                    Aktif
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="status_off" value="off" {{ $kategori->status == 'off' ? 'checked' : '' }}>
                <label class="form-check-label" for="status_off">
                    Tidak Aktif
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">  
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Data</button>
                <a href="{{ route('kategoris.index') }}" class="btn btn-secondary"><i class="fa fa-solid fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </form>
</div>
@endsection
