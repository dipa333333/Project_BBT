<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mengubah kolom 'status' menjadi VARCHAR(50) agar bisa menerima text 'aktif', 'nonaktif', dll.
        // Kita gunakan DB::statement agar kompatibel dengan berbagai versi Laravel tanpa Doctrine/DBAL.

        // Pilih salah satu baris di bawah sesuai database kamu (biasanya MySQL):

        // UNTUK MYSQL / MARIADB:
        DB::statement("ALTER TABLE sensors MODIFY status VARCHAR(50) NOT NULL DEFAULT 'aktif'");

        // UNTUK POSTGRESQL (Jika pakai pgsql):
        // DB::statement("ALTER TABLE sensors ALTER COLUMN status TYPE VARCHAR(50)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke ENUM jika di-rollback (Opsional)
        // DB::statement("ALTER TABLE sensors MODIFY status ENUM('online', 'offline') NOT NULL");
    }
};