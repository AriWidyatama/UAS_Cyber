<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
        $table->id();
        $table->string('judul_buku');
        $table->text('description');
        $table->string('penulis');
        $table->year('tahun_terbit')->nullable();
        $table->integer('jumlah_buku')->default(0);
        $table->string('gambar')->nullable(); // simpan nama file/folder gambar
        $table->string('category', 50);
        $table->enum('status', ['available', 'unavailable'])->default('available');
        $table->timestamps();

         // Kalau nanti mau foreign key ke tabel kategori
        // $table->foreign('id_kategori')->references('id_kategori')->on('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bukus');
    }
};
