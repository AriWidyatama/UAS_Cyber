<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="#" class="d-block">User</a>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-header">MAIN MENU</li>

      <li class="nav-item">
        <a href="{{ route('user.dashboard') }}" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>Dashboard</p>
        </a>
      </li>

      {{-- <li class="nav-item">
        <a href="{{ route('kategoris.index') }}" class="nav-link">
          <i class="nav-icon fas fa-list"></i>
          <p>Kategori</p>
        </a>
      </li> --}}

      {{-- <li class="nav-item">
        <a href="{{ route('bukus.index') }}" class="nav-link">
          <i class="nav-icon fas fa-book"></i>
          <p>Daftar Buku</p>
        </a>
      </li> --}}

      {{-- <li class="nav-item">
        <a href="/admin/daftarAnggota" class="nav-link">
          <i class="nav-icon fas fa-users"></i>
          <p>Daftar Anggota</p>
        </a>
      </li> --}}

      {{-- <li class="nav-item">
        <a href="/admin/daftarPeminjaman" class="nav-link">
          <i class="nav-icon fas fa-exchange-alt"></i>
          <p>Daftar Peminjaman</p>
        </a>
      </li> --}}

      <li class="nav-item">
        <a href="/user/profil" class="nav-link">
          <i class="nav-icon fas fa-user"></i>
          <p>Profil</p>
        </a>
      </li>

      <li class="nav-item">
          <a href="#" class="nav-link" 
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>LogOut</p>
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
              @csrf
          </form>
      </li>

    
    <script>
        document.getElementById('logout-link').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            document.getElementById('logout-form').submit(); // Submit the form
        });
    </script>
    
    {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form> --}} 
    {{-- baru --}}
    

      {{-- <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST" id="logout-form">
            @csrf
            <button type="submit" class="nav-link" style="background: none; border: none; color: inherit; cursor: pointer;">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>LogOut</p>
            </button>
        </form>
    </li> --}}
    
      {{-- <li class="nav-item">
        <a href="/" class="nav-link ">
            <i class="far fa-circle nav-icon"></i>
            <p>LogOut</p>
        </a>
    </li> --}}
      {{-- <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">Log Out</button>
    </form> --}}

    </ul>
  </nav>

<style>
  .nav-sidebar .nav-link {
    color: #495057;
    border-radius: 0.25rem;
    transition: background-color 0.3s, color 0.3s;
  }

  .nav-sidebar .nav-link:hover {
    background-color: #e9ecef;
    color: #495057;
  }

  .nav-sidebar .nav-link.active {
    background-color: #007bff;
    color: #fff;
  }

  .nav-sidebar .nav-icon {
    margin-right: 10px;
  }

  .nav-header {
    color: #6c757d;
    font-size: 0.75rem;
    text-transform: uppercase;
    font-weight: bold;
    margin-top: 1rem;
    margin-bottom: 0.5rem;
  }
</style>
