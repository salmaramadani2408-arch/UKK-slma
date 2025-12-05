<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('history_disposisi', function (Blueprint $table) {
    $table->id();
    $table->string('nomorsurat');
    $table->string('skpd');
    $table->date('Tgl_Surat');
    $table->string('Perihal');
    $table->date('Tgl_Diterima');
    $table->string('No_Agenda');
    $table->string('Sifat');
    $table->string('Dokumen');
    $table->string('Diteruskan_Ke');
    $table->enum('status', ['terkirim', 'diterima', 'selesai'])->default('terkirim');
    $table->text('dengan_hormat_harap')->nullable();
    $table->text('catatan')->nullable();
    $table->string('dikirim_oleh')->nullable();
    $table->timestamps();
    
    $table->foreign('nomorsurat')
          ->references('nomorsurat')
          ->on('disposisi')
          ->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_disposisi');
    }
};
