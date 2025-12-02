<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('disposisi', function (Blueprint $table) {
            $table->string('nomorsurat')->primary();
            $table->string('skpd');
            $table->date('Tgl_Surat');
            $table->string('Perihal');
            $table->date('Tgl_Diterima');
            $table->string('No_Agenda');
            $table->string('Sifat');
            $table->string('Dokumen');
            
            // Kolom untuk Kaban
            $table->string('Diteruskan_Ke')->nullable();
            $table->enum('status', ['pending', 'di_kaban', 'selesai'])->default('pending');
            $table->text('dengan_hormat_harap')->nullable();
            $table->text('catatan')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disposisi');
    }
};