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
                'judul_buku'   => 'Belajar Laravel Dasar',
                'description'  => 'Buku ini membahas konsep dasar framework Laravel untuk pemula.',
                'penulis'      => 'Andi Pratama',
                'tahun_terbit' => 2023,
                'jumlah_buku'  => 10,
                'gambar'       => 'laravel_dasar.jpg', // pastikan file ada di public/images
                'category'     => 'Pemrograman',
                'status'       => 'available',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'judul_buku'   => 'Algoritma dan Struktur Data',
                'description'  => 'Membahas algoritma dasar dan implementasi struktur data dalam pemrograman.',
                'penulis'      => 'Budi Santoso',
                'tahun_terbit' => 2021,
                'jumlah_buku'  => 5,
                'gambar'       => 'algoritma_struktur_data.jpg',
                'category'     => 'Ilmu Komputer',
                'status'       => 'available',
                'created_at'   => now(),
                'updated_at'   => now(),
            ]
        ]);
    }
}
