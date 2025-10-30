<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $pin = '';

    public function register()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'pin' => ['required', 'digits:6'],
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'pin' => Hash::make($this->pin),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended(route('dashboard', absolute: false));
    }
};
?>

<div class="max-w-md mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-2xl font-semibold text-center mb-6">Daftar Akun</h2>

    <form wire:submit="register" class="space-y-4">

        <div>
            <label class="block mb-1 text-sm font-medium">Nama</label>
            <input wire:model="name" type="text" class="form-input w-full" placeholder="Nama lengkap">
            @error('name') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium">Email</label>
            <input wire:model="email" type="email" class="form-input w-full" placeholder="Email aktif">
            @error('email') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium">Password</label>
            <input wire:model="password" type="password" class="form-input w-full" placeholder="Password">
            @error('password') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium">Konfirmasi Password</label>
            <input wire:model="password_confirmation" type="password" class="form-input w-full" placeholder="Ulangi password">
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium">PIN (6 Angka)</label>
            <input wire:model="pin" type="password" maxlength="6" inputmode="numeric" class="form-input w-full" placeholder="******">
            @error('pin') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn-primary w-full py-2">Daftar</button>
    </form>

    <p class="text-center mt-4 text-sm">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Masuk</a>
    </p>
</div>
