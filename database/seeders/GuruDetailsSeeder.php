<?php

namespace Database\Seeders;

use App\Models\GuruDetails;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class GuruDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guruRole = Role::findOrCreate('guru');

        $users = User::factory(5)->create();
        foreach ($users as $user) {
            $user->assignRole($guruRole);

            GuruDetails::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
