<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('history_disposisi', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['nomorsurat']);
        });
    }

    public function down(): void
    {
        Schema::table('history_disposisi', function (Blueprint $table) {
            // Restore foreign key jika rollback
            $table->foreign('nomorsurat')
                  ->references('nomorsurat')
                  ->on('disposisi')
                  ->onDelete('cascade');
        });
    }
};