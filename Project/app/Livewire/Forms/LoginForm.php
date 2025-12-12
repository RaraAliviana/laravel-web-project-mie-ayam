<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Helpers\AESEncryptor;
use Illuminate\Support\Facades\RateLimiter;

class LoginForm extends Form
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    protected function throttleKey(): string
    {
        return strtolower($this->email).'|'.request()->ip();
    }

    public function authenticate(): void
    {
        $key = $this->throttleKey();

        // ❗ Cek apakah user/ip sedang diblok
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'form.email' => "Terlalu banyak percobaan gagal. Coba lagi dalam {$seconds} detik.",
            ]);
        }

        // 🔐 Cari user berdasarkan email terenkripsi AES
        $encryptedEmail = AESEncryptor::encrypt($this->email);
        $user = User::where('email', $encryptedEmail)->first();

        if (!$user) {
            RateLimiter::hit($key, 30); // ⏳ Tambah 1 attempt + blok 15 detik kalau limit tercapai

            throw ValidationException::withMessages([
                'form.email' => 'Email tidak ditemukan.',
            ]);
        }

        // 🔐 Dekripsi password AES
        $decryptedPassword = AESEncryptor::decrypt($user->password);

        // ❌ Password salah
        if ($decryptedPassword !== $this->password) {

            RateLimiter::hit($key, 30); // ⏳ Tambah 1 attempt

            throw ValidationException::withMessages([
                'form.password' => 'Password salah.',
            ]);
        }

        // Jika berhasil login → reset counter
        RateLimiter::clear($key);

        // ✅ Login sukses
        Auth::login($user, $this->remember);
    }
}
