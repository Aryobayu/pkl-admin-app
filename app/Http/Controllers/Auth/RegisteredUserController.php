<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register', [
            'geminiApiKey' => config('services.gemini.key')
        ]);
    }

    /**
     * Handle an incoming registration request.
     * 
     * Controller ini telah diperbarui untuk mendukung registrasi dengan NIP
     * sebagai kredensial utama dan email sebagai field opsional.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input dengan rules yang disesuaikan untuk NIP dan email opsional
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nip' => [
                'required', 
                'string', 
                'min:12',           // NIP minimal 12 digit
                'max:18',           // NIP maksimal 18 digit
                'regex:/^\d+$/',    // Hanya boleh angka
                'unique:users,nip'  // NIP harus unik di database
            ],
            'email' => [
                'nullable',         // Email boleh kosong (opsional)
                'string', 
                'email', 
                'max:255', 
                'unique:users,email' // Email harus unik jika diisi
            ],
            'password' => [
                'required', 
                'confirmed',        // Harus cocok dengan password_confirmation
                Rules\Password::defaults()
            ],
        ], [
            // Custom error messages dalam bahasa Indonesia
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama lengkap maksimal 255 karakter.',
            
            'nip.required' => 'NIP (Nomor Induk Pegawai) wajib diisi.',
            'nip.min' => 'NIP minimal 12 digit.',
            'nip.max' => 'NIP maksimal 18 digit.',
            'nip.regex' => 'NIP hanya boleh berisi angka.',
            'nip.unique' => 'NIP sudah terdaftar. Gunakan NIP yang berbeda atau hubungi administrator jika ini adalah kesalahan.',
            
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'email.unique' => 'Email sudah terdaftar. Gunakan email yang berbeda.',
            
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ], [
            // Custom attribute names
            'name' => 'Nama Lengkap',
            'nip' => 'NIP',
            'email' => 'Email',
            'password' => 'Password',
        ]);

        // Bersihkan data sebelum menyimpan
        $validated = $this->sanitizeUserData($validated);

        try {
            // Buat user baru dengan data yang sudah divalidasi
            $user = User::create([
                'name' => $validated['name'],
                'nip' => $validated['nip'],
                'email' => $validated['email'], // Bisa null jika tidak diisi
                'password' => Hash::make($validated['password']),
                'role' => 'user', // Default role untuk registrasi baru
                'email_verified_at' => null, // User perlu verifikasi email jika ada email
            ]);

            // Trigger event untuk notifikasi atau proses lainnya
            event(new Registered($user));

            // Login otomatis setelah registrasi berhasil
            Auth::login($user);

            // Log aktivitas registrasi untuk audit
            $this->logRegistrationActivity($user, $request);

            // Redirect berdasarkan role (meskipun untuk registrasi baru selalu user)
            return $this->redirectBasedOnRole($user);

        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Registration failed', [
                'error' => $e->getMessage(),
                'nip' => $validated['nip'],
                'email' => $validated['email'],
                'ip' => $request->ip(),
            ]);

            // Kembalikan error ke form dengan pesan yang user-friendly
            return back()->withErrors([
                'email' => 'Terjadi kesalahan saat membuat akun. Silakan coba lagi atau hubungi administrator.'
            ])->withInput($request->except(['password', 'password_confirmation']));
        }
    }

    /**
     * Membersihkan dan memformat data user sebelum disimpan
     * 
     * @param array $data
     * @return array
     */
    private function sanitizeUserData(array $data): array
    {
        // Bersihkan nama dari spasi berlebih
        $data['name'] = trim($data['name']);
        $data['name'] = preg_replace('/\s+/', ' ', $data['name']); // Multiple spaces to single space
        
        // Bersihkan NIP dari karakter non-digit (jika ada)
        $data['nip'] = preg_replace('/[^0-9]/', '', $data['nip']);
        
        // Bersihkan email (jika ada)
        if (!empty($data['email'])) {
            $data['email'] = strtolower(trim($data['email']));
        } else {
            $data['email'] = null; // Pastikan null jika kosong
        }
        
        return $data;
    }

    /**
     * Menentukan redirect berdasarkan role user
     * 
     * @param User $user
     * @return RedirectResponse
     */
    private function redirectBasedOnRole(User $user): RedirectResponse
    {
        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Akun admin berhasil dibuat! Selamat datang, ' . $user->name);
        }

        // Untuk user biasa
        return redirect()->intended(RouteServiceProvider::HOME)
            ->with('success', 'Akun berhasil dibuat! Selamat datang di PAK Wi Online, ' . $user->name);
    }

    /**
     * Mencatat aktivitas registrasi untuk keperluan audit
     * 
     * @param User $user
     * @param Request $request
     */
    private function logRegistrationActivity(User $user, Request $request): void
    {
        \Log::info('User registered successfully', [
            'user_id' => $user->id,
            'name' => $user->name,
            'nip' => $user->nip,
            'email' => $user->email ?: 'not provided',
            'role' => $user->role,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'registration_time' => now(),
        ]);
    }

    /**
     * Validasi tambahan untuk memastikan data konsisten
     * Dapat dipanggil sebelum menyimpan data
     * 
     * @param array $data
     * @return bool
     */
    private function validateDataConsistency(array $data): bool
    {
        // Cek apakah NIP sudah ada (double check)
        if (User::where('nip', $data['nip'])->exists()) {
            return false;
        }

        // Cek email jika ada
        if (!empty($data['email']) && User::where('email', $data['email'])->exists()) {
            return false;
        }

        // Validasi format NIP
        if (!preg_match('/^\d{12,18}$/', $data['nip'])) {
            return false;
        }

        // Validasi nama tidak kosong setelah trim
        if (empty(trim($data['name']))) {
            return false;
        }

        return true;
    }

    /**
     * Method helper untuk generate NIP otomatis jika diperlukan
     * (untuk keperluan khusus seperti import data)
     * 
     * @return string
     */
    private function generateUniqueNip(): string
    {
        do {
            // Generate NIP dengan format: tahun sekarang + random 14 digit
            $nip = date('Y') . str_pad(random_int(0, 99999999999999), 14, '0', STR_PAD_LEFT);
        } while (User::where('nip', $nip)->exists());

        return $nip;
    }

    /**
     * Method untuk mengirim email verifikasi jika email tersedia
     * (dapat dipanggil setelah registrasi berhasil)
     * 
     * @param User $user
     */
    private function sendEmailVerificationIfApplicable(User $user): void
    {
        if ($user->email && !$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
        }
    }
}