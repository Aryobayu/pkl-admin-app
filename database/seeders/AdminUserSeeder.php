<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Seeder ini membuat akun administrator default dengan NIP
     * sebagai kredensial login utama.
     */
    public function run(): void
    {
        // Cek apakah admin dengan NIP ini sudah ada
        // Ini mencegah duplikasi data saat seeder dijalankan berulang kali
        $existingAdmin = User::where('nip', '199001010001')->first();
        
        if (!$existingAdmin) {
            // Buat akun admin baru dengan data lengkap termasuk NIP
            User::create([
                'name' => 'Administrator Sistem',
                'nip' => '199001010001', // NIP admin default (bisa disesuaikan)
                'email' => 'admin@pakwionline.com', // Email tetap ada untuk notifikasi
                'role' => 'admin',
                'password' => Hash::make('AdminPakWi2025!'), // Password kuat untuk admin
                'email_verified_at' => now(), // Admin langsung terverifikasi
            ]);
            
            // Tampilkan informasi di console saat seeder berjalan
            $this->command->info('✓ Admin user berhasil dibuat dengan NIP: 199001010001');
            $this->command->info('  Email: admin@pakwionline.com');
            $this->command->info('  Password: AdminPakWi2025!');
            $this->command->warn('  PENTING: Segera ganti password default setelah login pertama!');
        } else {
            $this->command->info('✓ Admin user dengan NIP 199001010001 sudah ada, tidak perlu dibuat lagi.');
        }

        // Opsional: Buat beberapa user sample dengan role 'user' untuk testing
        $this->createSampleUsers();
    }

    /**
     * Membuat beberapa user contoh untuk keperluan testing
     * Method ini opsional dan bisa dihapus jika tidak dibutuhkan
     */
    private function createSampleUsers()
    {
        $sampleUsers = [
            [
                'name' => 'Budi Santoso',
                'nip' => '199205150002',
                'email' => 'budi@pakwionline.com',
                'role' => 'user',
            ],
            [
                'name' => 'Sari Dewi',
                'nip' => '198803220003',
                'email' => 'sari@pakwionline.com', 
                'role' => 'user',
            ],
            [
                'name' => 'Agus Prakoso',
                'nip' => '199012100004',
                'email' => null,
                'role' => 'user',
            ]
        ];

        foreach ($sampleUsers as $userData) {
            // Cek apakah user dengan NIP ini sudah ada
            if (!User::where('nip', $userData['nip'])->exists()) {
                User::create(array_merge($userData, [
                    'password' => Hash::make('password123'), // Password default untuk sample user
                    'email_verified_at' => now(),
                ]));
                
                $this->command->info("✓ Sample user {$userData['name']} (NIP: {$userData['nip']}) berhasil dibuat");
            }
        }
    }
}