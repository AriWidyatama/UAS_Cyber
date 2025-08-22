# Simulasi Penyerangan dan Pencegahan Cyber Security

### Simulasi berfocus kepada website dengan tema perpus yang memiliki 2 sesi login yaitu user dan admin

## Clone Project
- Pindahkan terminal atau CMD ke folder yang diinginkan
- Clone project dengan perintah `git clone https://github.com/AriWidyatama/Simulasi_Cyber_Web.git`

## Siapkan Project Laravel
- Masuk ke directory laraver dengan menggunakan `cd .\perpus`
- Buatkan database untuk menyimpan data
- Atus koneksi di file `.env` bagian DB_DATABASE, DB_USERNAME, DB_PASSWORD yang disesuikan dengan koneksi yang dimiliki
- Buatkan link untuk upload gambar jika belum ada, dengan menggunakan perintah -> `php artisan storage:link`
- Migrasikan tabel dan tambahkan data seeder -> `php artisan migrate --seed`
- Jalankan Server Laravel -> `php artisan serve`

## SQL Injection
### Serangan dengan menyisipkan query SQL ke dalam input aplikasi
- Login Sebagai User
- Halaman dashboard hanya menampilkan buku yang tersedia
- Masukkan query `'OR '1'='1` pada bagian pencarian
- Dashboard akan menampilkan semua data, termasuk buku yang tidak tersedia

Cara Pencegahan: <br>
Gunakan Eloquent ORM dibandingkan raw query untuk mengambil data. Ubah file `.\perpus\app\Http\Controllers\UserDashboardController.php` bagian 
```PHP
$bukus = DB::select("SELECT * FROM bukus WHERE status = 'available'");

if ($request->filled('search')) {
    $search = $request->search;
    $bukus = DB::select("SELECT * FROM bukus WHERE judul_buku = '" . $_GET['search'] . "'");
}
```
menjadi
```PHP
$query = Buku::where('status', 'available');

if ($request->filled('search')) {
    $search = $request->search;
    $query->where(function($q) use ($search) {
        $q->where('judul_buku', 'like', "%{$search}%")
            ->orWhere('penulis', 'like', "%{$search}%")
            ->orWhere('category', 'like', "%{$search}%");
    });
}

if ($request->filled('category')) {
    $query->where('category', $request->category);
}

$bukus = $query->latest()->paginate(10);
$bukus->appends($request->query());
```
Setelah diubah jika mencari dengan query `'OR '1'='1` akan menampilkan hasil kosong

## IDOR (Insecure Direct Object Reference)
### Serangan dengan mengakses data milik orang lain hanya dengan mengganti ID pada URL atau parameter.
- Login sebagai user
- Buka halaman profil, kemudian tekan button edit
- Maka url akan berubah menjadi `/user/profil/3/edit`
- Pada bagian id (3) dapat dibuah menjadi id orang lain, misalkan menjadi `/user/profil/1/edit`
- Makan akan dapat mengakses data dengan id 3

Cara Pencegahan: <br>
Jangan mengambil data user berdasarkan id, melainkan berdasarkan sesi login. 
- Perbaiki code pada file `.\perpus\resources\views\admin\profil\show.blade.php` dan `.\perpus\resources\views\user\profil\show.blade.php` dengan mengubah bagian `route('user.profil.edit', $user->id)` menjadi `route('user.profil.edit')`.
- Pada file `.\perpus\routes\web.php` perbaiki route `/admin/profil/{id}/edit` dan `/user/profil/{id}/edit'` dengan menghapus bagian `/{id}`.
- Terakhir perbaiki file `.\perpus\app\Http\Controllers\ProfileController.php` dengan mengubah bagian 
    ```PHP
    public function edit($id)
    {
    $user = User::findOrFail($id);
    ```
    Menjadi
    ```PHP
    public function edit()
    {
        $user = Auth::user();
    ```

## XSS (Cross-Site Scripting)
### Serangan dengan menyisipkan kode JavaScript berbahaya ke halaman web agar dijalankan di browser korban.
Serangan XSS terdapat berbagai jenis mulai dari pop up hingga mengambil Cookies, yang lebih lengkapnya ada pada file `data_XSS.txt`.
- Buka terminal baru dan jalankan server XSS dengan perintah `python XSS_server.py`
- Login sebagai admin
- Pada aplikasi web, masuk ke halaman tambah data atau edit
- Pada bagian deskripsi masukkan script XSS yang diinginkan, misalkan po up, mengambil Cookies, dan mencatat ketikan (script dapat dilihap pada file `data_XSS.txt`)
- Ketika user ataupun admin mengklik tombol show pada data yang ditambahkan script, maka akan pergi ke halaman show sekaligus mengaktifkan script XSS
- Pop up akan muncul di halaman show, dan coba lakukan ketikan acak di halaman show tersebut
- Pada terminal yang menjalankan `XSS_server.py` akan muncul cookies dan ketikan yang dilakukan.

Cara Pencegahan: <br>
Laravel sudah menyediakan keamanan untuk mencegah XSS, pada bagian menampilkan show deskripsi gunakan `{{ $buku->description }}` dibandingkan `{!! $buku->description !!}` yang lebih rentan. 

## CSRF (Cross-Site Request Forgery)
### Serangan yang dapat mengirim request data melalui form palsu yang terpisah dari web asli.
1. Sengaja membuka Verify CSRF
    - Jalankan file `CSRF.html` menggunakan live server atau bisa membuat server dengan python di terminal -> `python -m http.server 5500` kemudian akses `http://127.0.0.1:5500/CSRF.html`
    - Isi data dan coba simpan, maka data akan masuk ke database padahal bukan dari laravel.

    Hal ini berhasil karena verifikasi CSRf pada laravel sengaja dibuka, untuk mencegahnya buka file `.\perpus\app\Http\Middleware\VerifyCsrfToken.php` dan hapus bagian `'/admin/bukus',` agar kembali ke setting laravel awal. Ketika dicoba kembali, maka pengiriman data akan gagal dan menampilkan page experied.

2. Membuatkan Sesi Laravel <br>
    Jika cara sebelumnya gagal, maka bisa dibuatkan sesi sendiri dan mengambil token CSRFnya agar bisa mengirimkan data. Semua hal tersebut dibuatkan pada file `CSRF.py` yang dijadikan suatu API agar bisa digunakan pada file `CSRF.html`
    - Jalankan API python di terminal -> `python CSRF.py`
    - Ganti target endpoint di file `CSRF.html` pada bagian form action dari `action="http://127.0.0.1:8000/admin/bukus"` menjadi `action="http://localhost:5000/submit-product"`
    - Isi data dan coba kirim. Maka data akan masuk ke database.

    Untuk mengatasinya dapat dibuatkan Middleware yang bisa membedakan akses setiap user, itu berarti jika aksesnya tidak sesuai maka form tidak akan bisa dikirimkan. Middleware sebelumnya sudah dibuatkan pada file `.\app\Http\Middleware\CheckRole.php`. Untuk menggunakannya, tambahkan middleware pada route di file `.\perpus\routes\web.php` pada bagian
    ```PHP
    // ADMIN
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/bukus', BukuController::class);
    // Profile
    Route::get('/admin/profil', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/admin/profil/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/admin/profil', [ProfileController::class, 'update'])->name('profile.update');

    // USER 
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/user/buku/{id}', [UserBukuController::class, 'show'])->name('user.bukus.show');
    // Profile
    Route::get('/user/profil', [ProfileController::class, 'show'])->name('user.profil.show');
    Route::get('/user/profil/edit', [ProfileController::class, 'edit'])->name('user.profil.edit');
    Route::put('/user/profil', [ProfileController::class, 'update'])->name('user.profil.update');
    ```
    Ditambahkan middleware menjadi:
    ```PHP
    // ADMIN
    Route::middleware(['auth', 'checkRole:admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('/admin/bukus', BukuController::class);

        // Profile
        Route::get('/admin/profil', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/admin/profil/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/admin/profil', [ProfileController::class, 'update'])->name('profile.update');
    });

    // USER
    Route::middleware(['auth', 'checkRole:user'])->group(function () {
        Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
        Route::get('/user/buku/{id}', [UserBukuController::class, 'show'])->name('user.bukus.show');

        // Profile
        Route::get('/user/profil', [ProfileController::class, 'show'])->name('user.profil.show');
        Route::get('/user/profil/edit', [ProfileController::class, 'edit'])->name('user.profil.edit');
        Route::put('/user/profil', [ProfileController::class, 'update'])->name('user.profil.update');
    });
    ```
    Jika sudah ditambahkan middleware, maka coba untuk mengirim ulang data, sehingga data yang dikirimkan tidak akan masuk.

3. CSRF dengan Cookies<br>
    Jika CSRF sebelumnya sudah tidak berhasil maka dapat dilakukan kembali dengan menggunakan Cookies dari pengguna yang sedang login.
    - Stop API CSRF sebelumnya dengan menekan `CTRL+C` pada terminal tempatnya berjalan agar tidak bentrok
    - Ambil Cookies dari pengguna yang sudah login, untuk latihan coba login sebagai admin, kemudian inspect -> Application -> Cookies -> laravel_session.
    - Copy token yang ada pada bagian laravel_session
    - Buka file `CSRF_Cookies.py`, pada bagian `laravel_session` ganti dengan token yang di copy sebleumnya.
    - Jalankan API di terminal dengan perintah -> 'python CSRF_Cookies.py`
    - Isi Kembali data dan kirim

    Dengan ini data berhasil dikirimkan kembali, namun diperlukan Cookies dari admin yang sedang login.

4. CSRF dengan Login <br>
    Sama halnya dengan yang menggunakan Cookies, hanya saja token laravel diganti dengan login menggunakan username dan password.
    - Stop API CSRF sebelumnya dengan menekan `CTRL+C` pada terminal tempatnya berjalan agar tidak bentrok
    - Buka file `CSRF_Login.py`, ganti bagian USERNAME dan PASSWORD dengan yang valid dan aksesnya adalah admin.
    - Jalankan API di terminal dengan perintah -> 'python CSRF_Login.py`
    - Isi Kembali data dan kirim

    Dengan ini data berhasil dikirimkan kembali, namun diperlukan username dan password dari admin.

5. Spam Data dengan CSRF
    Menggunakan CSRf untuk mengirim data palsu secara massal untuk memenuhi dan mengacaukan database.
    - Biarkan API CSRF tetap berjalan
    - Buka file `Spam_data.py` dan ganti humlah di `end =` menjadi jumlah data yang diinginkan.
    - Run code dengan perintah -> `python Spam_data.py`

    Maka data palsu akan di kirimkan dengan jumlah yang telah ditentukan.


## Shell Injection
### Serangan dengan menyisipkan perintah sistem (shell command) melalui input aplikasi, sehingga penyerang bisa menjalankan perintah berbahaya di server.
- Login seabagai admin atau bisa menggunakan form CSRF sebelumnya.
- Saat menambahkan data, drag and drop file `shell.jpg.php` ke bagian tambah foto (jika tidak bisa di form asli, gunakan form CSRF)
- Pada bagian daftar buku, pilih arahkan kursor ke bagian foto pada data yang ditambahkan
- Klik kanan lalu pilih open in new tab
- Pada bagian url dapat ditambahkan `shell.php?cmd=whoami` untuk melihat hasilnya
- Script php dapat dimodifikasi sebelum di upload, jika ingin mendapatkan hasil lain.

Cara mengatasi: <br>
- Buka file `.\perpus\app\Http\Controllers\BukuController.php`
- Buatkan agar hanya menerima gambar dengan mengedit bagian `'gambar' => 'nullable` menjadi `'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'`

## Brute Force
### Metode menyerang login dengan mencoba kombinasi username/password secara terus menerus sampai berhasil.
- Buka file `brute_force.ipynb`
- Jalankan import pada cell pertama
- Pada cell 2 tambahkan beberapa username dan password yang diperkirakan ada kemungkinan.
- Jalankan Cell ke 2 untuk melihat hasilnya
- Pada cell ke 3 dapat digunakan untuk mencari kombinasi password dari 0
- Ketika cell ke 3 dijalankan maka akan dicari berbagai password mulai dari a, b,..., aa, ab,... hingga ketemu. namun semakin panjang password akan membutuhkan waktu semakin lama.

Cara mengatasi:
Brute force dapat diatasi dengan membatasi jumlah request yang bisa dilakukan, sebelumnya sudah dibuatkan middleware untuk mengatasi hal tersebut pada file `.\perpus\app\Http\Middleware\BlockIpThrottle.php`. Untuk menerapkannya perlu diedit pada file `.\perpus\routes\web.php` bagian 
``` PHP
Route::post('/login', [AuthController::class, 'login'])->name('login');
```
Menjadi
```PHP
Route::middleware(['block.ip'])->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});
```
Dimana ketika diterapkan akan membatasi jumlah maksimal request sebanyak 5 dalam 1 menit. Sehingga ketika code brute force di run ulang hanya akan dapat menerima 5 hasil dalam 1 menit, dan semua request lainnya akan langsung ditolak.

## DoS (Denial of Service)
### Serangan yang membuat server tidak bisa digunakan dengan membanjiri permintaan (request) hingga sistem kelebihan beban.
- Buka file `DOS.py`
- Isi bagain MAX_REQUESTS dan THREAD_COUNT dengan jumlah yang diinginkan, semakin banyak maka semakin berat beban ke server.
- Jalankan code dengan perintah -> `python DOS.py`
