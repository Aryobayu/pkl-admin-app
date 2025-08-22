<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Migration ini menambahkan kolom NIP (Nomor Induk Pegawai) ke tabel users.
     * NIP akan menjadi kredensial login utama menggantikan email.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom NIP setelah kolom name
            // NIP bersifat unik dan nullable untuk sementara (untuk data existing)
            $table->string('nip', 18)->after('name')->nullable()->unique();
            
            // Membuat email menjadi nullable (opsional)
            // Ini memungkinkan pengguna tidak wajib mengisi email
            $table->string('email')->nullable()->change();
            
            // Membuat unique constraint pada email menjadi nullable
            // Artinya email tetap unik jika diisi, tapi boleh kosong
            $table->dropUnique(['email']);
        });
        
        // Membuat unique index baru untuk email yang mengabaikan nilai NULL
        Schema::table('users', function (Blueprint $table) {
            $table->unique('email');
        });
    }

    /**
     * Reverse the migrations.
     *  
     * Jika migration di-rollback, kembalikan struktur ke kondisi semula
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom NIP
            $table->dropColumn('nip');
            
            // Kembalikan email menjadi required (not nullable)
            $table->string('email')->nullable(false)->change();
        });
    }
};