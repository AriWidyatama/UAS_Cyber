@extends('masteradminlte.layout')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info shadow-sm rounded">
        <div class="inner">
          <h3>{{ $anggotaCount ?? 0 }}</h3>
          <p>Anggota</p>
        </div>
        <div class="icon">
          <i class="fas fa-users"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success shadow-sm rounded">
        <div class="inner">
          {{-- <h3>{{ $kategoriCount }}</h3> --}}
          <h3>4</h3>
          <p>Kategori</p>
        </div>
        <div class="icon">
          <i class="fas fa-th-list"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning shadow-sm rounded">
        <div class="inner">
          <h3>{{ $bukuCount }}</h3>
          <p>Buku</p>
        </div>
        <div class="icon">
          <i class="fas fa-book"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger shadow-sm rounded">
        <div class="inner">
          <h3>{{ $pinjamanCount ?? 0 }}</h3>
          <p>Jumlah Pinjaman</p>
        </div>
        <div class="icon">
          <i class="fas fa-chart-line"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
</div>

<style>
  .small-box {
    position: relative;
    display: block;
    background: #fff;
    border-radius: .25rem;
    box-shadow: 0 2px 4px rgba(0,0,0,.1);
    transition: all .3s ease;
  }
  .small-box:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,.2);
  }
  .small-box .inner {
    padding: 10px;
  }
  .small-box .icon {
    top: 10px;
    right: 15px;
    z-index: 0;
    color: rgba(255,255,255,.8);
  }
  .small-box .small-box-footer {
    position: relative;
    display: block;
    background: rgba(0,0,0,.1);
    color: #fff;
    text-align: center;
    padding: 10px;
    border-top: 1px solid rgba(0,0,0,.125);
  }
</style>
@endsection
