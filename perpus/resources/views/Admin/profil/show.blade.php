@extends('masteradminlte.layout')

@section('content')
<div class="container">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <h1>Profil Admin</h1>
  <div class="card p-3">
    <div class="row">
      <div class="col-md-3">
        <img src="{{ $user->image ? asset('storage/'.$user->image) : asset('dist/img/user2-160x160.jpg') }}" class="img-fluid rounded" alt="Avatar">
      </div>
      <div class="col-md-9">
        <p><strong>Nama:</strong> {{ $user->nama }}</p>
        <p><strong>Username:</strong> {{ $user->username }}</p>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <!-- route dengan id = route('profile.edit', $user->id)
          route tanpa id = route('profile.edit') -->
          <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-warning">Edit Profil</a>
      </form>
      </div>
    </div>
  </div>
</div>
@endsection
