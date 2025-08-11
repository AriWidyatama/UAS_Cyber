@extends('masteradminlte.layout')

@section('content')
<div class="container">
  <h1>Edit Profil Admin</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" name="nama" id="nama" class="form-control" 
             value="{{ old('nama', $user->nama) }}" required>
      @error('nama')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" name="username" id="username" class="form-control" 
             value="{{ old('username', $user->username) }}" required>
      @error('username')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="image" class="form-label">Foto Profil (Opsional)</label>
      <input type="file" name="image" id="image" class="form-control">
      @error('image')
        <div class="text-danger">{{ $message }}</div>
      @enderror

      @if($user->image)
        <img src="{{ asset('storage/' . $user->image) }}" alt="Foto Profil" width="120" class="mt-2 rounded">
      @endif
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</div>
@endsection
