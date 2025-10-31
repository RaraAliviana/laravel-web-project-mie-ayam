<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Helpers\EncryptHelper;

class LoginForm extends Form
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function authenticate(): void
    {
        $user = User::where('email', $this->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'Email tidak ditemukan.',
            ]);
        }

        // Dekripsi password terenkripsi dari database
        $decryptedPassword = EncryptHelper::decryptTwoLayer($user->password);

        if ($decryptedPassword !== $this->password) {
            throw ValidationException::withMessages([
                'password' => 'Password salah.',
            ]);
        }

        Auth::login($user, $this->remember);
    }
}