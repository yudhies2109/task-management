<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
// Dijalankan saat migrate untuk menambahkan kolom status akun.
public function up(): void
{
    // Mengubah struktur tabel users yang sudah tersedia.
    Schema::table('users', function (Blueprint $table) {
        // Menyimpan status aktif/nonaktif akun.
        // Default true agar user yang sudah ada dan user baru berstatus aktif.
        $table->boolean('is_active')->default(true);
    });
}

// Dijalankan saat rollback untuk membatalkan perubahan migration ini.
public function down(): void
{
    // Mengubah struktur tabel users.
    Schema::table('users', function (Blueprint $table) {
        // Menghapus kolom is_active yang ditambahkan oleh metode up().
        $table->dropColumn('is_active');
    });
}
};
