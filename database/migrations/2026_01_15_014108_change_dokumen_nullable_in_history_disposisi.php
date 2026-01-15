<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('history_disposisi', function (Blueprint $table) {
            // Ubah kolom Dokumen jadi nullable
            $table->string('Dokumen')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('history_disposisi', function (Blueprint $table) {
            // Kembalikan jadi NOT NULL jika rollback
            $table->string('Dokumen')->nullable(false)->change();
        });
    }
};