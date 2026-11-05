<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Membuat Role utama yang digunakan dalam sistem
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $adminCabangRole = Role::firstOrCreate(['name' => 'admin_cabang']);
        $tutorRole = Role::firstOrCreate(['name' => 'tutor']);

        // 2. Membuat akun Super Admin default secara otomatis
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'), // Bisa Anda ubah nanti
            ]
        );

        // 3. Menghubungkan akun tersebut dengan role super_admin
        $superAdmin->assignRole($superAdminRole);
    }
}