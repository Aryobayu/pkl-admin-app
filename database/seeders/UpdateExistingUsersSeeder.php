<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateExistingUsersSeeder extends Seeder
{
    /**
     * Seeder ini bertugas untuk mengupdate data user yang sudah ada
     * tetapi belum memiliki NIP, dan memberikan NIP kepada mereka.
     * 
     * Seeder ini juga akan mengupdate password user lama agar 
     * menggunakan sistem yang lebih aman.
     */
    public function run(): void
    {
        $this->command->info('🔄 Memulai update data user yang sudah ada...');

        // Update user dengan email admin@example.com (user ID 1)
        $adminUser = User::where('email', 'admin@example.com')->first();
        if ($adminUser && is_null($adminUser->nip)) {
            $adminUser->update([
                'name' => 'Super Administrator',
                'nip' => '199001010000', // NIP khusus untuk super admin
                'role' => 'admin',
                'email_verified_at' => now(),
                'password' => Hash::make('SuperAdmin2025!'), // Update password yang lebih kuat
            ]);
            
            $this->command->info("✓ User 'Super Administrator' berhasil diupdate dengan NIP: 199001010000");
            $this->command->warn("  Password baru: SuperAdmin2025! (Segera ganti setelah login!)");
        }

        // Update user dengan email aakuinanyaar11@gmail.com (user ID 2)
        $regularUser = User::where('email', 'aakuinanyaar11@gmail.com')->first();
        if ($regularUser && is_null($regularUser->nip)) {
            $regularUser->update([
                'name' => 'Aryo Bayu Prakasa',
                'nip' => '199503180005', // NIP berdasarkan pola yang umum
                'role' => 'user',
                'email_verified_at' => now(),
            ]);
            
            $this->command->info("✓ User 'Aryo Bayu Prakasa' berhasil diupdate dengan NIP: 199503180005");
        }

        // Update semua user lain yang belum memiliki NIP
        $usersWithoutNip = User::whereNull('nip')->get();
        
        foreach ($usersWithoutNip as $index => $user) {
            // Generate NIP otomatis berdasarkan ID dan pattern
            $generatedNip = $this->generateNipForUser($user, $index);
            
            $user->update([
                'nip' => $generatedNip,
                'email_verified_at' => $user->email_verified_at ?? now(),
            ]);
            
            $this->command->info("✓ User '{$user->name}' berhasil diupdate dengan NIP: {$generatedNip}");
        }

        $this->command->info('✅ Semua user existing berhasil diupdate dengan NIP!');
        
        // Tampilkan ringkasan
        $this->showUserSummary();
    }

    /**
     * Generate NIP untuk user yang belum memiliki NIP
     * 
     * @param User $user
     * @param int $index
     * @return string
     */
    private function generateNipForUser(User $user, int $index): string
    {
        // Pattern: 1990 + 01 + 01 + 000X (tahun + bulan + tanggal + urutan)
        // Untuk user existing, kita gunakan pattern tahun 1990-1999
        $baseYear = 1990;
        $month = str_pad(($index % 12) + 1, 2, '0', STR_PAD_LEFT);
        $day = str_pad(($index % 28) + 1, 2, '0', STR_PAD_LEFT);
        $sequence = str_pad($user->id + 100, 4, '0', STR_PAD_LEFT);
        
        return $baseYear . $month . $day . $sequence;
    }

    /**
     * Menampilkan ringkasan semua user setelah update
     */
    private function showUserSummary(): void
    {
        $this->command->info("\n📊 RINGKASAN DATA USER SETELAH UPDATE:");
        $this->command->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
        
        $allUsers = User::all();
        
        foreach ($allUsers as $user) {
            $roleLabel = $user->role === 'admin' ? '👑 Admin' : '👤 User';
            $emailInfo = $user->email ? "({$user->email})" : "(Tanpa Email)";
            
            $this->command->info("{$roleLabel} | NIP: {$user->nip} | {$user->name} {$emailInfo}");
        }
        
        $adminCount = User::where('role', 'admin')->count();
        $userCount = User::where('role', 'user')->count();
        
        $this->command->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
        $this->command->info("📈 Total: {$allUsers->count()} user ({$adminCount} admin, {$userCount} user biasa)");
    }
}