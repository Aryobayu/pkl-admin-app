<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * 
     * Rules ini sudah diubah untuk menerima 'credential' yang bisa berupa
     * NIP atau email, memberikan fleksibilitas kepada pengguna.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'credential' => ['required', 'string'], // Menerima NIP atau email
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Custom validation messages dalam bahasa Indonesia
     * untuk memberikan feedback yang mudah dipahami pengguna
     */
    public function messages(): array
    {
        return [
            'credential.required' => 'NIP atau email wajib diisi.',
            'credential.string' => 'NIP atau email harus berupa teks yang valid.',
            'password.required' => 'Password wajib diisi.',
            'password.string' => 'Password harus berupa teks.',
        ];
    }

    /**
     * Custom attribute names untuk pesan error
     * agar lebih user-friendly dalam bahasa Indonesia
     */
    public function attributes(): array
    {
        return [
            'credential' => 'NIP atau Email',
            'password' => 'Kata Sandi',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     * 
     * Method ini adalah jantung dari proses autentikasi fleksibel.
     * Sistem akan mencoba mendeteksi apakah input berupa NIP atau email,
     * kemudian melakukan autentikasi berdasarkan jenis kredensial tersebut.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $credential = $this->input('credential');
        $password = $this->input('password');
        $remember = $this->boolean('remember');

        // Deteksi jenis kredensial yang dimasukkan pengguna
        $credentialType = $this->detectCredentialType($credential);
        
        // Siapkan array kredensial untuk autentikasi
        $credentials = $this->prepareCredentials($credential, $password, $credentialType);

        // Attempt authentication berdasarkan jenis kredensial
        if (! Auth::attempt($credentials, $remember)) {
            RateLimiter::hit($this->throttleKey());

            // Berikan pesan error yang sesuai dengan jenis kredensial
            $errorMessage = $this->getAuthErrorMessage($credentialType);
            
            throw ValidationException::withMessages([
                'credential' => $errorMessage,
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Mendeteksi jenis kredensial yang dimasukkan pengguna
     * 
     * @param string $credential
     * @return string 'nip', 'email', atau 'unknown'
     */
    private function detectCredentialType(string $credential): string
    {
        // Membersihkan input dari spasi di awal dan akhir
        $credential = trim($credential);
        
        // Cek apakah berupa email (mengandung @ dan struktur domain)
        if (filter_var($credential, FILTER_VALIDATE_EMAIL)) {
            return 'email';
        }
        
        // Cek apakah berupa NIP (hanya angka dengan panjang 12-18 karakter)
        if (preg_match('/^\d{12,18}$/', $credential)) {
            return 'nip';
        }
        
        // Jika tidak cocok dengan pattern manapun
        return 'unknown';
    }

    /**
     * Menyiapkan array kredensial untuk proses autentikasi
     * berdasarkan jenis kredensial yang terdeteksi
     * 
     * @param string $credential
     * @param string $password
     * @param string $credentialType
     * @return array
     */
    private function prepareCredentials(string $credential, string $password, string $credentialType): array
    {
        $credentials = ['password' => $password];
        
        switch ($credentialType) {
            case 'nip':
                $credentials['nip'] = $credential;
                break;
                
            case 'email':
                $credentials['email'] = $credential;
                break;
                
            default:
                // Jika jenis tidak dikenali, coba sebagai email dulu, lalu NIP
                // Ini adalah fallback mechanism untuk kompatibilitas
                $credentials['email'] = $credential;
                break;
        }
        
        return $credentials;
    }

    /**
     * Mendapatkan pesan error yang sesuai berdasarkan jenis kredensial
     * 
     * @param string $credentialType
     * @return string
     */
    private function getAuthErrorMessage(string $credentialType): string
    {
        switch ($credentialType) {
            case 'nip':
                return 'NIP atau password yang Anda masukkan tidak cocok dengan data kami.';
                
            case 'email':
                return 'Email atau password yang Anda masukkan tidak cocok dengan data kami.';
                
            default:
                return 'Kredensial yang Anda masukkan tidak cocok dengan data kami. Pastikan Anda memasukkan NIP (12-18 digit) atau alamat email yang valid.';
        }
    }

    /**
     * Ensure the login request is not rate limited.
     * 
     * Sistem rate limiting untuk mencegah brute force attack.
     * Menggunakan kredensial dan IP address sebagai bagian dari throttle key.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'credential' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     * 
     * Kunci untuk rate limiting menggunakan kredensial dan IP address
     * untuk keamanan yang lebih baik. Sistem akan membatasi percobaan
     * login berdasarkan kombinasi kredensial dan IP.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('credential')).'|'.$this->ip());
    }

    /**
     * Method helper untuk mendapatkan kredensial login
     * dalam format yang diperlukan untuk autentikasi
     */
    public function getCredentials(): array
    {
        $credential = $this->input('credential');
        $credentialType = $this->detectCredentialType($credential);
        
        return $this->prepareCredentials(
            $credential,
            $this->input('password'),
            $credentialType
        );
    }

    /**
     * Override method prepareForValidation untuk preprocessing input
     * Membersihkan input kredensial dari karakter yang tidak perlu
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('credential')) {
            $credential = trim($this->input('credential'));
            
            // Jika input hanya berisi angka, bersihkan dari karakter non-digit
            // untuk memastikan NIP dalam format yang benar
            if (preg_match('/^[\d\s\-\.]+$/', $credential)) {
                $cleanCredential = preg_replace('/[^0-9]/', '', $credential);
                $this->merge(['credential' => $cleanCredential]);
            } else {
                // Untuk email, bersihkan spasi berlebih
                $this->merge(['credential' => $credential]);
            }
        }
    }
}