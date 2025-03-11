<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use App\Filament\Resources\SiswaResource;
use App\Models\SiswaDetails;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;

class CreateSiswa extends CreateRecord
{
    protected static string $resource = SiswaResource::class;

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        $user->markEmailAsVerified();
        $user->assignRole('siswa');

        $siswa = SiswaDetails::create([
            'nis' => $data['nis'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'tempat_lahir' => $data['tempat_lahir'],
            'user_id' => $user->id,
            'kelas_id' => $data['kelas_id'],
        ]);

        return $siswa;
    }
}
