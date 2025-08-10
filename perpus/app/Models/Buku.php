<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\KategoriController;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'bukus'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key
    // public $timestamps = false;

    protected $fillable = [
        'judul_buku',
        'penulis',
        'tahun_terbit',
        'jumlah_buku',
        'gambar',
        'category',
        'description',
        'status',
    ];

    // public function kategori()
    // {
    //     return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    // }
}
