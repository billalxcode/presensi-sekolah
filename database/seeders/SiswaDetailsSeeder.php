<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\SiswaDetails;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SiswaDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswaRole = Role::findOrCreate('siswa');

        $users = User::factory(5)->create();
        foreach ($users as $user) {
            $user->assignRole($siswaRole);

            SiswaDetails::factory()->create([
                'user_id' => $user->id,
                'kelas_id' => Room::all('id')->random(),
            ]);
        }

        $user_test = User::where('email', '=', 'test@admin.com');
        if ($user_test->exists()) {
            // ignore create siswa details if exists
            if (SiswaDetails::whereUserId($user_test->first()->id)->exists()) {
                return;
            }
            SiswaDetails::factory()->create([
                'user_id' => $user_test->first()->id,
                'kelas_id' => Room::all('id')->random(),
            ]);
        }
    }
}
