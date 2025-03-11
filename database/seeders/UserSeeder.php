<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::findOrCreate('admin');
        $siswaRole = Role::findOrCreate('siswa');
        $guruRole = Role::findOrCreate('guru');

        if (! User::where('email', '=', 'admin@admin.com')->exists()) {
            User::factory()->create([
                'name' => 'Super Admin',
                'email' => 'admin@admin.com',
            ])->assignRole($adminRole);
        }
        if (! User::where('email', '=', 'test@admin.com')->exists()) {
            User::factory()->create([
                'name' => 'Siswa Coba',
                'email' => 'test@admin.com',
            ])->assignRole($siswaRole);
        }
    }
}
