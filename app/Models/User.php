<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'nip',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    /**
     * Menentukan field mana yang akan digunakan untuk autentikasi.
     * 
     * Method ini memberitahu Laravel bahwa kita ingin menggunakan NIP
     * sebagai pengganti email untuk proses login. Laravel akan mencari
     * user berdasarkan NIP saat proses autentikasi.
     * 
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'nip'; // Menggunakan NIP sebagai identifier utama untuk login
    }

    /**
     * Method helper untuk mendapatkan nama lengkap user
     * dengan informasi role untuk keperluan display
     * 
     * @return string
     */
    public function getDisplayNameAttribute()
    {
        $roleName = $this->role === 'admin' ? 'Administrator' : 'Pengguna';
        return $this->name . ' (' . $roleName . ')';
    }

    /**
     * Method helper untuk mengecek apakah user adalah admin
     * 
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Method helper untuk format NIP dengan pemisah
     * Contoh: 19851234567890123456 menjadi 198512345678901234567
     * 
     * @return string|null
     */
    public function getFormattedNipAttribute()
    {
        if (!$this->nip) {
            return null;
        }
        
        // Format NIP dengan pemisah untuk readability
        // Anda bisa sesuaikan format sesuai standar institusi
        return chunk_split($this->nip, 4, ' ');
    }

    /**
     * Scope untuk mencari user berdasarkan NIP atau nama
     * Berguna untuk fitur pencarian admin
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('nip', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
    }
}
