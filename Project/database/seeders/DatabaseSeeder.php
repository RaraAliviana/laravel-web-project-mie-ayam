<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Helpers\AESEncryptor;
use App\Helpers\EncryptHelper;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            MenuSeeder::class,
        ]);

        // HAPUS admin lama berdasarkan email terenkripsi
        $encryptedAdminEmail = AESEncryptor::encrypt('admin@example.com');

        User::where('email', $encryptedAdminEmail)->delete();

        // ROLE
        $adminRole = Role::firstOrCreate(['name' => 'admin'], ['guard_name' => 'web']);
        $userRole  = Role::firstOrCreate(['name' => 'user'],  ['guard_name' => 'web']);

        // PERMISSION
        $permissions = [
            'view posts',
            'create posts',
            'edit posts',
            'delete posts',
            'manage users',
            'view dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission], ['guard_name' => 'web']);
        }

        $adminRole->syncPermissions($permissions);
        $userRole->syncPermissions(['view posts', 'view dashboard']);

        // ============================
        // 🟦 BUAT ADMIN
        // email & password → AES
        // pin → EncryptHelper (2 layer)
        // ============================
        $admin = User::create([
            'name'     => 'Admin User',
            'email'    => AESEncryptor::encrypt('admin@example.com'),
            'password' => AESEncryptor::encrypt('password'),
            'pin'      => EncryptHelper::encryptTwoLayer('123456'),
        ]);

        $admin->assignRole('admin');

        // ============================
        // 🟩 BUAT USER BIASA
        // ============================
        $user = User::create([
            'name'     => 'Regular User',
            'email'    => AESEncryptor::encrypt('user@example.com'),
            'password' => AESEncryptor::encrypt('password123'),
            'pin'      => EncryptHelper::encryptTwoLayer('654321'),
        ]);

        $user->assignRole('user');

        // KONFIRMASI
        $this->command->info('Admin User created:');
        $this->command->info('Email: admin@example.com');
        $this->command->info('Password: password');
        $this->command->info('PIN: 123456');

        $this->command->info('');
        $this->command->info('Regular User created:');
        $this->command->info('Email: user@example.com');
        $this->command->info('Password: password123');
        $this->command->info('PIN: 654321');
    }
}
