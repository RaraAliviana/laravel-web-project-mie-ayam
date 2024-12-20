<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat role admin jika belum ada
        $adminRole = Role::firstOrCreate(['name' => 'admin'], ['guard_name' => 'web']);

        // Buat permission jika belum ada
        $permissions = ['view posts', 'create posts', 'delete posts'];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission], ['guard_name' => 'web']);
        }

        // Berikan semua permission ke admin
        $adminRole->syncPermissions($permissions);
    }
}
