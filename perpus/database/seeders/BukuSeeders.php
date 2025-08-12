<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bukus')->insert([
        [
            'judul_buku'   => 'Laskar Pelangi',
            'description'  => 'Novel inspiratif karya Andrea Hirata yang menceritakan perjuangan anak-anak Belitung.',
            'penulis'      => 'Andrea Hirata',
            'tahun_terbit' => 2005,
            'jumlah_buku'  => 0,
            'gambar'       => null,
            'category'     => 'Novel',
            'status'       => 'unavailable',
            'created_at'   => now(),
            'updated_at'   => now(),
        ],
        [
            'judul_buku'   => 'One Piece',
            'description'  => 'Komik petualangan bajak laut karya Eiichiro Oda.',
            'penulis'      => 'Eiichiro Oda',
            'tahun_terbit' => 1997,
            'jumlah_buku'  => 10,
            'gambar'       => null,
            'category'     => 'Komik',
            'status'       => 'available',
            'created_at'   => now(),
            'updated_at'   => now(),
        ],
        [
            'judul_buku'   => 'National Geographic Edisi Februari',
            'description'  => 'Majalah yang membahas fenomena alam, budaya, dan ilmu pengetahuan.',
            'penulis'      => 'Redaksi National Geographic',
            'tahun_terbit' => 2023,
            'jumlah_buku'  => 0,
            'gambar'       => null,
            'category'     => 'Majalah',
            'status'       => 'unavailable',
            'created_at'   => now(),
            'updated_at'   => now(),
        ],
        [
            'judul_buku'   => 'Kompas Edisi 17 Agustus',
            'description'  => 'Kumpulan berita terkini di Indonesia pada peringatan kemerdekaan.',
            'penulis'      => 'Redaksi Kompas',
            'tahun_terbit' => 2024,
            'jumlah_buku'  => 20,
            'gambar'       => null,
            'category'     => 'Berita',
            'status'       => 'available',
            'created_at'   => now(),
            'updated_at'   => now(),
        ],
        [
            'judul_buku'   => 'Matematika Dasar untuk Pemula',
            'description'  => 'Buku panduan belajar matematika dasar untuk semua usia.',
            'penulis'      => 'Siti Rahmawati',
            'tahun_terbit' => 2022,
            'jumlah_buku'  => 8,
            'gambar'       => null,
            'category'     => 'Pendidikan',
            'status'       => 'available',
            'created_at'   => now(),
            'updated_at'   => now(),
        ],
        [
            'judul_buku'   => 'Harry Potter dan Batu Bertuah',
            'description'  => 'Novel fantasi tentang petualangan Harry Potter di sekolah sihir Hogwarts.',
            'penulis'      => 'J.K. Rowling',
            'tahun_terbit' => 1997,
            'jumlah_buku'  => 12,
            'gambar'       => null,
            'category'     => 'Novel',
            'status'       => 'available',
            'created_at'   => now(),
            'updated_at'   => now(),
        ],
        [
            'judul_buku'   => 'Naruto',
            'description'  => 'Komik aksi petualangan ninja karya Masashi Kishimoto.',
            'penulis'      => 'Masashi Kishimoto',
            'tahun_terbit' => 1999,
            'jumlah_buku'  => 9,
            'gambar'       => null,
            'category'     => 'Komik',
            'status'       => 'available',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]
    ]);

    }
}
