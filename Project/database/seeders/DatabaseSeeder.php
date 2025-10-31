<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Helpers\EncryptHelper;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            MenuSeeder::class,
        ]);

        User::where('email', 'admin@example.com')->delete();

        $adminRole = Role::firstOrCreate(['name' => 'admin'], ['guard_name' => 'web']);
        $userRole = Role::firstOrCreate(['name' => 'user'], ['guard_name' => 'web']);

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

        // Membuat user admin - event akan assign role admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => EncryptHelper::encryptTwoLayer('password'),
            'pin' => EncryptHelper::encryptTwoLayer('123456'),
        ]);

        // Membuat user biasa - event akan assign role user
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => EncryptHelper::encryptTwoLayer('password123'),
            'pin' => EncryptHelper::encryptTwoLayer('654321'),
        ]);

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