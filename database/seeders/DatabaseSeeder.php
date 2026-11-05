<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions Spatie
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Buat Role Hak Akses (Wajib ada agar sistem mengenali rolenya)
        Role::firstOrCreate(['name' => 'super_admin']);
        Role::firstOrCreate(['name' => 'admin_cabang']);
        Role::firstOrCreate(['name' => 'tutor']);

        // 2. Buat Akun Super Admin Utama (Pintu masuk pertama kali)
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password123'),
            ]
        );
        
        // Berikan role super_admin ke akun tersebut
        $superAdmin->assignRole('super_admin');
    }
}