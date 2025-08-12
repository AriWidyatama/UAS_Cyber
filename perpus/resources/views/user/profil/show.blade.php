@extends('usermasteradminlte.layout') <!-- atau masteradminlte.layout kalau pakai itu -->

@section('content')
<div class="container">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <h1>Profil Saya</h1>
  <div class="card p-3">
    <div class="row">
      <div class="col-md-3">
        <img src="{{ $user->image ? asset('storage/'.$user->image) : asset('dist/img/user2-160x160.jpg') }}" class="img-fluid rounded" alt="Avatar"> 
      </div>
      <div class="col-md-9">
        <p><strong>Nama:</strong> {{ $user->nama }}</p>
        <p><strong>Username:</strong> {{ $user->username }}</p>

        <!-- route dengan id = route('user.profil.edit', $user->id)
          route tanpa id = route('user.profil.edit') -->
        <a href="{{ route('user.profil.edit', $user->id) }}" class="btn btn-warning">Edit Profil</a>
      </div>
    </div>
  </div>
</div>
@endsection
